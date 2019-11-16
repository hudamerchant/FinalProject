<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends MY_Controller{
        public function index(){
            $data['view'] = 'Logout';
            $this->session->unset_userdata('logged_in');
            $this->load->view('layout',$data);
        }
    }

?>