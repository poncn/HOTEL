<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Admin_model');
    }

    /**
     * 登录页面
     */
    public function index()
    {
//        $this->Admin_model->setLogout();
        if (false !== $this->Admin_model->getCurrentLogin()) {
            redirect(site_url('Client/index'));
        }

        $this->load->view('admin/login');

    }

    /**
     * 响应登录请求
     */
    public function doLogin()
    {

        $retData = [
            'errorCode' => 1,
            'message' => '登录失败'
        ];

        $login = $this->input->post([
            'username', 'password'
        ], true);

        foreach ($login as $k => $v) {
            if (!isset($v[0])) {
                $retData['message'] = "$k 不能为空，请返回修改";
                $this->jsonOut($retData);
            }

        }

        if ($this->Admin_model->verifyLogin($login['username'], $login['password'])) {
            $retData = [
                'errorCode' => 0,
                'redirectUrl' => site_url('User')
            ];
        }
        $this->jsonOut($retData);
    }

    /**
     * 接收SSO登录推送
     * @param string $requestString
     */
    public function ssoLogin($requestString = '')
    {
        $this->load->library('SSOClient');

        if (is_array(($ret = $this->SSOClient->verify($requestString))) && ('0000' === $ret['errorCode'])) {
            //设置目标用户登录逻辑
            if ($this->Admin_model->getUserByUsername($ret['username'])) {
                $this->Admin_model->setLogin($ret['username']);
                redirect(site_url());
            }
        }
        echo $ret['message'];
    }


}
