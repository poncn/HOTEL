<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    private $introViewTable='intro';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function index()
	{
	    $this->load->helper('appraise');
	    $data=$this->Public_model->getUsers($this->introViewTable);

		$this->loadView('home/index',[
		    'intro'=>$data
        ]);
	}


}
