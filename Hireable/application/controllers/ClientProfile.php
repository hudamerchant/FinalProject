<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ClientProfile extends MY_Controller{
        public function index(){
            $data['view'] = 'CProfile';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Profile -'.$data['site_title']; 
            $this->load->view('layout',$data);
    }

?>