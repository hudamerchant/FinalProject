<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddFreelancerReview extends MY_Controller{
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
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $data['view'] = 'AddFreelancerReview';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'AddFreelancerReview -'.$data['site_title']; 
    
                        //Client info
                        $data['freelancer_info'] = $user;
                        return $this->load->view('layout',$data);
                    }
                }
                elseif($user->role_id == 2)
                {
                    return redirect(site_url('Client'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }

?>