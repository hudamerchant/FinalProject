<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About_us extends MY_Controller{
        public function index(){
            $data['view'] = 'About_us';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'About Us -'.$data['site_title']; 
            $this->load->view('layout',$data);
    
        }
    }

?>