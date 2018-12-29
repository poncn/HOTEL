<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 响应回程校验 控制器
     */
    public function index()
    {
        $this->load->model('Request_model');
        $requestString = $this->input->post('return_verify', true);

        $this->jsonOut($this->Request_model->verifyRequest($requestString));
    }
}
