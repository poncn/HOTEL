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

    public function index(){
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
        if ($data['username'] === null) {
            return '用户名不能为空，请修改。';
        } else if ($data['password'] === null) {
            return '密码不能为空，请修改。';
        } else if ($data['rePassword'] === null) {
            return '重复密码不能为空，请修改。';
        } else if ($data['password'] !== $data['rePassword']) {
            return '两次密码输入不一致，请修改。';
        } else if ($this->Admin_model->getUserByUserName($data['username']) !== false) {
            return '此用户名已被使用，请修改。';
        }
        return true;
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

        $alert['message'] = $this->verify($data);

        if ($alert['message']) {
            $result = $this->Admin_model->addUserWithParams($data['username'], $data['password']);
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

        $this->loadView('admin/admin_create', [
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

        $set = $this->input->post([
            'username', 'password'
        ]);
        $set['id']=$id;



        $alert['message'] = $this->verify($data);

        if ($alert['message']) {
            $result=$this->Admin_model->editUserByUserId($id,$set);
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
