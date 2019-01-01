<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{

    public function loadView($views = '', $assign = []
        , $isLoadHeaderFooter = true, $header = 'home/inc/header', $footer = 'home/inc/footer')
    {

        if ($isLoadHeaderFooter) {
            $this->load->view($header, $assign);
        }

        if (is_array($views) && count($views)) {
            foreach ($views as $view) {
                $this->load->view($view, $assign);
            }
        } else {
            $this->load->view($views, $assign);
        }

        if ($isLoadHeaderFooter) {
            $this->load->view($footer);
        }

    }

    public function jsonOut($data){
        return $this->output->set_output(json_encode($data));
    }

}
