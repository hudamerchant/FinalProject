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

                        foreach($freelancerDetails as $freelancerDetail){                            
                            $this->data['freelancerDetail'] = $freelancerDetail;
                        }

                        //loading freelancer categories
                        $this->load->model('FCategories');
                        $fetchingFreelancerCategories []= ['table_name'=>'categories', 'column_with'=>'freelancer_category.category_id = categories.category_id']; 
                        $whereFreelancerID = [
                            'freelancer_category.user_id' => $freelancer_user_id
                        ];
                        $selectArray = [
                            'categories'.'.category' 
                                ];
                        $results = $this->FCategories->multiple_joins($fetchingFreelancerCategories,$whereFreelancerID,$selectArray)->result();                        
                        $this->data['results'] = $results;

                        //loading Reviews
                        $this->load->model('Reviews_Model');
                        $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'reviews.sender_id = users.user_id']; 
                        $whereFreelancerID = [
                            'reviews.receiver_id' => $freelancer_user_id
                        ];
                        $selectArray = [
                            'reviews.sender_id',
                            'reviews.receiver_id',
                            'reviews.rating',
                            'reviews.review',
                            'reviews.updated_at',
                            'users.name',
                            'users.email',
                            'users.profile_pic'
                        ];
                        $reviewResults = $this->Reviews_Model->multiple_joins($fetchingProjects,$whereFreelancerID,$selectArray, 'DESC','reviews.updated_at')->result();
                        // var_dump($reviewResults);die;
                        $this->data['reviewResults'] = $reviewResults;

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