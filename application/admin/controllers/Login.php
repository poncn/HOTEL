<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    private $adminTable='admin';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    /**
     * 登录页面
     */
    public function index()
    {
//        $this->Public_model->setLogout();
        if (false !== $this->Public_model->getCurrentLogin()) {
            redirect(site_url('Admin/index'));
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

        if ($this->Public_model->verifyLogin($this->adminTable,$login['username'], $login['password'])) {
            $retData = [
                'errorCode' => 0,
                'redirectUrl' => site_url('Login/index')
            ];
        }

        $this->jsonOut($retData);
    }
    public function logout(){
        $this->Public_model->setLogout();
        redirect('Login/index');
    }

}
