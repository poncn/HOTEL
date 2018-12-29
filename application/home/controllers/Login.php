<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $adminTable='admin';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
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
            if ($this->Public_model->getUserByUsername($ret['username'])) {
                $this->Public_model->setLogin($ret['username']);
                redirect(site_url());
            }
        }
        echo $ret['message'];
    }

    public function test(){
        $this->load->library('SSOClient');
        $result=$this->SSOClient;
        var_dump($result);
//        $this->ssoLogin($txt);
    }

}
