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
                $user   = $this->Users->getData('DESC',$where)->row();
                if($user->role_id == 1){

                    redirect(site_url('Client'));
                    
                }
                elseif($user->role_id == 2)
                {
                    $this->data['view'] = 'FreelancerProfileForClients';
                    $this->data['site_title'] = 'Hireable';
                    $this->data['page_title'] = 'Freelancer Profile - '.$this->data['site_title']; 

                    if($freelancer_user_id){
                        $count = 0;
                        $whereUserId = [
                            'user_id' => $freelancer_user_id
                        ];
                        $freelancerData = $this->Users->getData('DESC',$whereUserId)->row();
                        $this->data['freelancerDetails'][$count]['user_id'] = $freelancerData->user_id;
                        $this->data['freelancerDetails'][$count]['name'] = $freelancerData->name;
                        $this->data['freelancerDetails'][$count]['dob'] = $freelancerData->dob;
                        $this->data['freelancerDetails'][$count]['gender'] = $freelancerData->gender;
                        $this->data['freelancerDetails'][$count]['email'] = $freelancerData->email;
                        if($freelancerData->profile_pic != ''){

                            $this->data['freelancerDetails'][$count]['profile_pic'] = $this->data['image_path'].$freelancerData->profile_pic;
                        }

                        $freelancerDetails = $this->data['freelancerDetails'];
                        // var_dump($freelancerDetails);die;

                        foreach($freelancerDetails as $freelancerDetail){
                            
                            $this->data['freelancerDetail'] = $freelancerDetail;
                        }
                        // var_dump($freelancerDetail);
                        $this->load->model('CommentsClient');
                        $whereFreelancerID = [
                            'receiver_id' => $freelancer_user_id
                        ];
                        $reviews = $this->CommentsClient->getData('DESC',$whereFreelancerID)->result();
                        
                        $arr = [];
                        foreach ($reviews as $review) {
                            
                            $arr[] = $review->review;

                            $senderId = $review->user_id ;

                            $whereSenderId = [
                                'user_id' => $senderId,
                                
                            ];
                            $sendersData = $this->Users->getData($whereSenderId)->result();
                            //var_dump($sendersData);die;
                            foreach ($sendersData as $senderData) {
                                $data['senderData'] = $senderData;
                                // var_dump($senderData);
                            }
                        }
                        $this->data['comment'] = $arr;
        
                        $this->data['client_info'] = $user;

                        $this->load->model('FCategories');
                        $fetchingProjects []= ['table_name'=>'categories', 'column_with'=>'freelancer_category.category_id = categories.category_id']; 
                        $whereFreelancerID = [
                            'user_id' => $freelancer_user_id
                        ];
                        $selectArray = [
                            'categories'.'.category' 
                                ];
                        $results = $this->FCategories->multiple_joins($fetchingProjects,$whereFreelancerID,$selectArray)->result();
                        $this->data['results'] = $results;
                        // var_dump($results);die;


                    }
    
                    $this->load->view('layout',$this->data);
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }