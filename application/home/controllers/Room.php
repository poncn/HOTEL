<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends MY_Controller {

    private $introViewTable='room_intro';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function index($id=0)
    {
        $data=$this->Public_model->getUser($this->introViewTable,$select = '*',['id'=>(int)$id]);
        $this->loadView('home/room',[
            'v'=>$data
        ]);
    }


}
