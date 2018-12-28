<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public $userTable = 'users';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Admin_model');
    }

    public function table()
    {
        $result = $this->Admin_model->getUsers($userTable);

        $this->loadView('admin/user_table', [
            'data' => $result
        ]);
    }


}
