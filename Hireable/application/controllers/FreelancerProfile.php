<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FreelancerProfile extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1)
                {        
                    $data['view'] = 'FProfile';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Profile -'.$data['site_title']; 

                    //Freelancer info
                    $data['freelancer_info'] = $user;
                    $this->load->view('layout',$data);
                }
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client'));
                }
            }
            else
            {
                redirect(site_url('Login'));
            }

        }
    }

?>