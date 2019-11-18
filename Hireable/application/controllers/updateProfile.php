<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateProfile extends MY_Controller{
        function __construct(){
        parent::__construct();
    }
        public function index(){
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                redirect(site_url('updateProfile'));
            }
            $data['view'] = 'updateProfile';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Update -'.$data['site_title'];                    
            $this->load->view('layout',$data);
        }
    }

?>