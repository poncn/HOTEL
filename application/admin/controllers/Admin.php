<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Admin_model');
        $this->load->Model('Request_model');
    }

    public function index()
    {
        $this->loadView('admin/index');
    }

    public function table()
    {
        $result = $this->Admin_model->getUsers();

        $this->loadView('admin/admin_table', [
            'data' => $result
        ]);
    }

    public function create($username = '')
    {
        if (!($data = $this->Admin_model->getUserByUserName($username))) {
            $this->loadView('admin/admin_create');
        } else {
            $this->loadView('admin/admin_create', [
                'data' => $data
            ]);
        }
    }

    public function verify($data = [])
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                    'required' => '用户名为必填项',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => array(
                    'required' => '密码为必填项',
                ),
            ),
            array(
                'field' => 'rePassword',
                'label' => 'rePassword',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'required' => '重复密码为必填项',
                    'matches' => '两次密码不一致'
                ),
            ),
        );

        $this->form_validation->set_rules($config);
        $result = $this->form_validation->run();
        if (!$result) {
            $error = $this->form_validation->error_array();
            foreach ($error as $e => $v) {
                if (isset($v[0])) {
                    return $v;
                }
            }
        }
        return true;
    }

    public function upFile()
    {
        $config['upload_path'] = 'public/uploads/admin/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = date('Ymdhim') . rand(1, 9999999) . time();
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        return $config;
    }

    public function insert()
    {
        $alert = [
            'errorCode' => 0,
            'message' => '创建失败'
        ];

        $config=$this->upFile();

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else if (!($this->upload->do_upload('head_portrait'))) {
            $alert['message'] = $this->upload->display_errors('', '');
        }
            var_dump($config);



//        $path = $config['upload_path'] . $this->upload->data('file_name');

////
//        if ($alert['message']===true) {
//            $result = $this->Admin_model->addUser([
//                'username'=>$data['username'],
//                'password'=>$data['password'],
//                'head_portrait'=>$path
//            ]);
//            if ($result) {
//                $alert = [
//                    'errorCode' => 1,
//                    'message' => '创建成功'
//                ];
//            } else {
//                $alert = [
//                    'errorCode' => 0,
//                    'message' => '创建失败'
//                ];
//            }
//        }
//
//        $this->loadView('admin/admin_create', [
//            'alert' => $alert
//        ]);

    }

    public function update($id = 0)
    {
        $alert = [
            'errorCode' => 0,
            'message' => '修改失败'
        ];

        $data = $this->input->post([
            'username', 'password', 'rePassword'
        ]);

        $set = $this->input->post([
            'username', 'password'
        ]);
        $set['id'] = $id;


        $alert['message'] = $this->verify($data);

        if ($alert['message']) {
            $result = $this->Admin_model->editUserByUserId($id, $set);
            if ($result) {
                $alert = [
                    'errorCode' => 1,
                    'message' => '修改成功'
                ];
            } else {
                $alert = [
                    'errorCode' => 0,
                    'message' => '修改失败'
                ];
            }
        }

        $this->loadView('admin/admin_create', [
            'alert' => $alert
        ]);

    }

    public function delete()
    {
        $retArr = [
            'errorCode' => 1
        ];

        $Id = (int)$this->input->post('Id');

        if ($this->Admin_model->deleteUserById($Id)) {
            $retArr['errorCode'] = 0;
        }

        $this->jsonOut($retArr);

    }

    /**
     *  跳转客户端
     */
    public function getClient($clientId = 0)
    {
        if (false !== ($url = $this->Request_model->createRequest($this->user->username, (int)$clientId))) {
            redirect($url);
        }
    }

    public function doChangPassword()
    {
        $retData = [
            'errorCode' => 1,
            'message' => '修改失败'
        ];

        $params = $this->input->post([
            'password', 'newPassword', 'rePassword'
        ], true);

        foreach ($params as $k => $v) {
            if (!isset($v[0])) {
                $retData['message'] = "$k 不能为空，请返回修改";
                $this->jsonOut($retData);
                break;
            }
        }

        if (false === $this->Admin_model->verifyLogin($this->user->username, $params['password'])) {
            $retData['message'] = '当前密码不正确，请重新输入';
            $this->jsonOut($retData);
        }

        if ($params['newPassword'] !== $params['rePassword']) {
            $retData['message'] = '两次密码输入不一致，请重新输入';
            $this->jsonOut($retData);
        }

        if ($this->Admin_model->changeUserPassword($this->user->username, $params['newPassword'])) {
            $retData = [
                'errorCode' => 0,
                'message' => '修改完成，请使用新密码重新登录',
                'redirectUrl' => site_url()
            ];
        }

        $this->jsonOut($retData);

        $this->Admin_model->setLogout();

    }
}
