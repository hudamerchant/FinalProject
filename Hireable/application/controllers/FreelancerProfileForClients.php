<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FreelancerProfileForClients extends MY_Controller{
        public function index($freelancer_user_id = false){
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

                    if($freelancer_user_id){
                        $count = 0;
                        $whereUserId = [
                            'user_id' => $freelancer_user_id
                        ];
                        $freelancerData = $this->Users->getData($whereUserId)->row();
                        $data['freelancerDetails'][$count]['user_id'] = $freelancerData->user_id;
                        $data['freelancerDetails'][$count]['name'] = $freelancerData->name;
                        $data['freelancerDetails'][$count]['dob'] = $freelancerData->dob;
                        $data['freelancerDetails'][$count]['gender'] = $freelancerData->gender;
                        $data['freelancerDetails'][$count]['email'] = $freelancerData->email;

                        $freelancerDetails = $data['freelancerDetails'];

                        foreach($freelancerDetails as $freelancerDetail){
                            
                            $data['freelancerDetail'] = $freelancerDetail;
                        }
                        $this->load->model('CommentsClient');
                        $whereFreelancerID = [
                            'receiver_id' => $freelancer_user_id
                        ];
                        $reviews = $this->CommentsClient->getData($whereFreelancerID)->result();
                        
                        $arr = [];
                        foreach ($reviews as $review) {
                            
                            $arr[] = $review->review;
                        }
                        $data['comment'] = $arr;
        
                        $data['client_info'] = $user;


                    }
    
                    $this->load->view('layout',$data);
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }