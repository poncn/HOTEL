<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller
{
    public $tableName = 'comment';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/comment_table', [
            'comments' => $result
        ]);
    }
}
