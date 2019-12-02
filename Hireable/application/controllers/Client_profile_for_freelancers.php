<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Client_profile_for_freelancers extends MY_Controller{
        public function index($client_user_id = false){
            function __construct(){
                parent::__construct();
            }
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if($user->role_id == 1){

                    $this->data['view'] = 'client_profile_for_freelancers';
                    $this->data['site_title'] = 'Hireable';
                    $this->data['page_title'] = 'Client Profile - '.$this->data['site_title']; 

                    if($client_user_id){
                        $count = 0;
                        $whereUserId = [
                            'user_id' => $client_user_id
                        ];
                        $clientData = $this->Users->getData('DESC',$whereUserId)->row();
                        $this->data['clientDetails'][$count]['user_id'] = $clientData->user_id;
                        $this->data['clientDetails'][$count]['name'] = $clientData->name;
                        $this->data['clientDetails'][$count]['dob'] = $clientData->dob;
                        $this->data['clientDetails'][$count]['gender'] = $clientData->gender;
                        $this->data['clientDetails'][$count]['email'] = $clientData->email;

                        if($clientData->profile_pic != ''){
                            $this->data['clientDetails'][$count]['profile_pic'] = $this->data['image_path'].$clientData->profile_pic;
                        }

                        $clientDetails = $this->data['clientDetails'];
                        // var_dump($clientDetails);die;
                        foreach($clientDetails as $clientDetail){                            
                            $this->data['clientDetail'] = $clientDetail;
                        }

                        $this->load->model('CProfile');
                        
                        $gettingClientProfileData = $this->CProfile->getData('DESC',$whereUserId)->row();
                        if($gettingClientProfileData != null){
                            $this->data['orgDescription'] = $gettingClientProfileData->org_description;
                            // var_dump($this->data['orgDescription']);die;
                        }

                        //loading Reviews
                        $this->load->model('Reviews_Model');
                        $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'reviews.sender_id = users.user_id']; 
                        $whereClientId = [
                            'reviews.receiver_id' => $client_user_id
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
                        $reviewResults = $this->Reviews_Model->multiple_joins($fetchingProjects,$whereClientId,$selectArray, 'DESC','reviews.updated_at')->result();
                        $this->data['reviewResults'] = $reviewResults;
                        
                    }
                    $this->load->view('layout',$this->data);
                    
                }
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client_dashboard'));
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }