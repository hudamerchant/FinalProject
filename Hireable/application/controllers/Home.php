<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends MY_Controller{
        public function index(){
            $data['view'] = 'Home';
            $data['page_title'] = 'Home';
            $this->load->view('layout',$data);
    
        }
    }

?>