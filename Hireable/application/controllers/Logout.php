<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends MY_Controller{
        public function index(){
            $data['view'] = 'Logout';
            $this->session->set_userdata('logged_in',false);
            $this->load->view('layout',$data);
            redirect('Login');
        }
    }

?>