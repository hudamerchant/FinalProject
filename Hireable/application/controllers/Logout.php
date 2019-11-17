<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends MY_Controller{
        public function index(){
            $data['view'] = 'Logout';
            $this->session->unset_userdata('logged_in');
            if(isset($_SESSION['freelancerRole'])){
                $this->session->unset_userdata('freelancerRole'); 
            }
            if(isset($_SESSION['ClientRole'])){
                $this->session->unset_userdata('ClientRole'); 
            }
            $this->load->view('layout',$data);
        }
    }

?>