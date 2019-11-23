<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FreelancerProfileForClients extends MY_Controller{
        public function index($project_apply_id = false){
            function __construct(){
                parent::__construct();
            }
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1){

                    redirect(site_url('Client'));
                    
                }
                elseif($user->role_id == 2)
                {
                    $data['view'] = 'FreelancerProfileForClients';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Freelancer Profile - '.$data['site_title']; 
    
                    $this->load->view('layout',$data);
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }