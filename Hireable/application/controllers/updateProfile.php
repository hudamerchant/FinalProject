<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateProfile extends MY_Controller{
        public function index(){
            $data['view'] = 'updateProfile';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Update -'.$data['site_title'];                    
            $this->load->view('layout',$data);
        }
    }

?>