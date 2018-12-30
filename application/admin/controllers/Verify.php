<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model');

    }

    /**
     * 响应回程校验 控制器
     */
    public function index()
    {

        $this->load->model('Request_model');
        $requestString = $this->input->post('return_verify', true);
//        echo $requestString;
        $this->jsonOut($this->Request_model->verifyRequest($requestString));
    }

    public function test($requestString='username=usernmae&request_time=1546160591&signature=e9706ff52f09994f4697a04810ea4cce'){
        $result=$this->Request_model->verifyRequest($requestString);
        var_dump($result);
    }
}
