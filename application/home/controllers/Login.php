<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    private $tableName='admin';
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Public_model');
        $this->load->Model('Request_model');
    }


    /**
     * 接收SSO登录推送
     *
     * @param string $requestString
     */
    public function ssoLogin($requestString = '')
    {
        $this->load->library('SSOClient');
        if (is_array(($ret = $this->ssoclient->verify($requestString))) && ('0000' === $ret['errorCode'])) {
            //设置目标用户登录逻辑

            if ($user=$this->Public_model->getUserByUsername($this->tableName,$ret['username'],['username','head_portrait'])) {
                $this->Public_model->setLogin($user);
                redirect(site_url('Home/index'));
            }
        }
        echo $ret['message'];
    }

    public function logout(){
        $this->Public_model->setLogout();
        redirect('Home/index');
    }
}
