<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    private $tableName='admin';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');

    }

    public function index()
    {
        $this->loadView('admin/index');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/admin_table', [
            'admins' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getUserById($this->tableName,$id))) {
            $this->loadView('admin/create/admin_create');
        } else {
            $this->loadView('admin/create/admin_create', [
                'data' => $data
            ]);
        }
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|regex_match[/[A-Za-z0-9]/]|is_unique[admin.username]|min_length[3]|max_length[9]',
                'errors' => array(
                    'required' => '用户名为必填项',
                    'regex_match' => '用户名必须是英文字母和数字',
                    'is_unique' => '用户名已存在',
                    'min_length' => '用户名最少由3个字母或数字组成',
                    'max_length' => '用户名最多由9个字母或数字组成',
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

        $data = $this->input->post([
            'username', 'password', 'rePassword'
        ]);

        $config = $this->upFile();

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else if (!($this->upload->do_upload('head_portrait'))) {
            $alert['message'] = $this->upload->display_errors('', '');
        } else {

            $path = $config['upload_path'] . $this->upload->data('file_name');

            $result = $this->Public_model->addUser($this->tableName,[
                'username' => $data['username'],
                'password' => $data['password'],
                'head_portrait' => $path
            ]);
            if ($result) {
                $alert = [
                    'errorCode' => 1,
                    'message' => '创建成功'
                ];
            } else {
                $alert = [
                    'errorCode' => 0,
                    'message' => '创建失败'
                ];
            }
        }
        $this->loadView('admin/create/admin_create', [
            'alert' => $alert
        ]);

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

        $config = $this->upFile();

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else if (!($this->upload->do_upload('head_portrait'))) {
            $alert['message'] = $this->upload->display_errors('', '');
        } else {

            $path = $config['upload_path'] . $this->upload->data('file_name');

            $result = $this->Public_model->editUserByUserId($this->tableName,$id, [
                'id' => $id,
                'username' => $data['username'],
                'password' => $data['password'],
                'head_portrait' => $path
            ]);
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
        $this->loadView('admin/create/admin_create', [
            'alert' => $alert
        ]);

    }

    public function delete()
    {
        $retArr = [
            'errorCode' => 1
        ];

        $Id = (int)$this->input->post('Id');

        if ($this->Public_model->deleteUserById($this->tableName,$Id)) {
            $retArr['errorCode'] = 0;
        }

        $this->jsonOut($retArr);

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

        if (false === $this->Public_model->verifyLogin($this->tableName,$this->user->username, $params['password'])) {
            $retData['message'] = '当前密码不正确，请重新输入';
            $this->jsonOut($retData);
        }

        if ($params['newPassword'] !== $params['rePassword']) {
            $retData['message'] = '两次密码输入不一致，请重新输入';
            $this->jsonOut($retData);
        }

        if ($this->Public_model->changeUserPassword($this->tableName,$this->user->username, $params['newPassword'])) {
            $retData = [
                'errorCode' => 0,
                'message' => '修改完成，请使用新密码重新登录',
                'redirectUrl' => site_url()
            ];
        }

        $this->jsonOut($retData);

        $this->Public_model->setLogout();

    }
}
