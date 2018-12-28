<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends MY_Controller
{
    public $tableName = 'room';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/room_table', [
            'rooms' => $result
        ]);
    }
}
