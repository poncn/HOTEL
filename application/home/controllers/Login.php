<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    private $tableName='users';
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Public_model');
        $this->load->Model('Request_model');
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|regex_match[/[A-Za-z0-9]/]|is_unique[users.username]|min_length[3]|max_length[9]',
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

    public function register(){
        $user=$this->input->post([
            'username','password','rePassword'
        ]);
        if (($ret=$this->verify()) !== true) {
            $alert = $ret;
        }else{
            $result=$this->Public_model->addUser($this->tableName,[
                'username'=>$user['username'],
                'password'=>$user['password'],
                'head_portrait'=>'public/admin/img/avatar.jpg'
            ]);
            if ($result) {
                $alert = '注册成功';
            } else {
                $alert = '注册失败';
            }
        }
        $this->jsonOut($alert);
    }

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

        if ($this->Public_model->verifyLogin($this->tableName,$login['username'], $login['password'])) {
            $retData = [
                'errorCode' => 0,
                'redirectUrl' => site_url('Home/index')
            ];
        }

        $this->jsonOut($retData);
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
