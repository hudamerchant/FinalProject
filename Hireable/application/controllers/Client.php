<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Client extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){ 
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 2)
                {
                    $data['view']       = 'CDashboard';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Dashboard -'.$data['site_title'];                    
                    $this->load->view('layout',$data);
                }
                elseif($user->role_id == 1)
                {
                    redirect(site_url('Freelancer'));
                }
            }
            else
            {
                redirect(site_url('Login'));
            }

        }
    }