<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About_us extends MY_Controller{
        public function index(){
            $data['view'] = 'About_us';
            $data['page_title'] = 'About_us';
            $this->load->view('layout',$data);
    
        }
    }

?>