<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddFreelancerReview extends MY_Controller{
        public function index(){
            function __construct(){
                parent::__construct();
            }
                $this->load->model('Users');
                if($this->session->userdata('logged_in')){
                    $where  = [ 'email' => $this->session->userdata('user_info') ];
                    $user   = $this->Users->getData($where)->row();
                    if($user->role_id == 1)
                    {
                        $data['view'] = 'AddFreelancerReview';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'AddFreelancerReview -'.$data['site_title']; 
    
                        //Client info
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