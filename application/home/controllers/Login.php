<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
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
            if ($this->Public_model->getUserByUsername($ret['username'])) {
                $this->Public_model->setLogin($ret['username']);
                redirect(site_url());
            }
        }
        echo $ret['message'];
    }

    public function test($requestString = 'username=username&request_time=59&signature=1ebfe4db6f9b6798e5d4a4edcf57abd1')
    {
        $this->load->library('SSOClient');

//        1ebfe4db6f9b6798e5d4a4edcf57abd1
//        $result = md5('wyYmEPADwRSz66gNwdbyYMxkKRH3VEihusername59');
        $result = $this->ssoclient->verify($requestString);
        var_dump($result);
//        $this->ssoLogin($txt);
    }

}
