<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FreelancerProfile extends MY_Controller{
        public function index(){
            $data['view'] = 'FProfile';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Profile -'.$data['site_title']; 
            $this->load->view('layout',$data);
    }

?>