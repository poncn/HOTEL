<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends My_Controller
{

    private $tableName='request';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    /**
     * 用户首页
     */
    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/request_table', [
            'request' => $result
        ]);
    }


}
