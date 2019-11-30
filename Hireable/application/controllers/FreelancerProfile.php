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
                $user   = $this->Users->getData('DESC',$where)->row();
                if($user->profile_pic != ''){
                    $this->data['profile_pic'] = $this->data['image_path'].$user->profile_pic;
                }
                // var_dump($this->data['profile_pic']);die;
                if($user->role_id == 1)
                {   
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $this->data['view'] = 'FProfile';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Profile - '.$this->data['site_title']; 
                        
                        $this->data['freelancer_info'] = $user;

                        $this->load->model('FProfile');
                        $whereFreelancerId       =   [  
                            'user_id'         => $user->user_id
                        ];
                        $gettingFreelancerProfileData = $this->FProfile->getData('DESC',$whereFreelancerId)->row();
                        if($gettingFreelancerProfileData != null){
                            $this->data['profileDescription'] = $gettingFreelancerProfileData->profile_description;
                            // var_dump($this->data['profileDescription']);die;
                        }
                        
                        // loading freelancer categories
                        $this->load->model('FCategories');
                        $fetchingFreelancerCategories []= ['table_name'=>'categories', 'column_with'=>'freelancer_category.category_id = categories.category_id']; 
                        $whereUserID = [
                            'freelancer_category.user_id' => $user->user_id
                        ];
                        $selectArray = [
                            'freelancer_category.updated_at',
                            'categories.category' 
                        ];
                        $results = $this->FCategories->multiple_joins($fetchingFreelancerCategories,$whereUserID,$selectArray,'DESC')->result();
                        $this->data['results'] = $results;
                        
                        //loading Reviews
                        $this->load->model('Reviews_Model');
                        $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'reviews.sender_id = users.user_id']; 
                        $whereUserId = [
                            'receiver_id' => $user->user_id
                        ];
                        $selectArray = [
                            'reviews.sender_id',
                            'reviews.receiver_id',
                            'reviews.rating',
                            'reviews.review',
                            'reviews.updated_at',
                            'users.user_id',
                            'users.name',
                            'users.email',
                            'users.profile_pic'
                        ];
                        $reviewResults = $this->Reviews_Model->multiple_joins($fetchingProjects,$whereUserId,$selectArray, 'DESC','reviews.updated_at')->result();
                        // var_dump($reviewResults);die;
                        $this->data['reviewResults'] = $reviewResults;
                        $avg_rating = [];

                        foreach($reviewResults as $reviewResult){
                            $userID = $reviewResult->receiver_id;
                            $where  = ['receiver_id'=>$userID];
                            $select = 'avg(rating)';
                            
                            $Ratings = $this->Reviews_Model->retrieve_ratings('DESC',$select,$where);
                            $avg_rating[$userID] = $Ratings ;
                            // var_dump($avg_rating);die;
                        }
                        $this->data['ratings'] = $avg_rating;

                        return $this->load->view('layout',$this->data);

                    }     
                       
                }
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client'));
                }
                $this->load->view('layout',$this->data);
            }
            else
            {
                redirect(site_url('Login'));
            }         
        }
        public function upload(){
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = ['email' => $this->session->userdata('user_info')];
                $user   = $this->Users->getData('DESC', $where)->row();
            
                if ($user->role_id == 2) {
                    return redirect(site_url('Client'));
                } elseif ($user->role_id == 1) {
                    if (!$user->updated_profile) {
                        return redirect(site_url('updateFProfile'));
                    } else {
                        $response = [];
                        $user_file = 'file_name';
                        $file = $this->upload_file($user_file);
                        if(isset($file['file_name']))
                        {    
                            $fileData = [
                                'profile_pic'=> $file['file_name'],
                                'updated_at' => date("Y-m-d H:i:s")
                            ];
                            $whereUserID = [
                                'user_id' => $user->user_id,
                            ];
                            $this->Users->updateData($fileData, $whereUserID );
                            $response["status"]  = "success";
                            $response["message"] = "Profile Pic has been uploaded successfully";
                        }else{
                            $this->data['file_error_key'] = $file;
                            if($this->data['file_error_key']){
                                $this->data['file_error_key'] = str_replace('<p>','',$this->data['file_error_key']);
                                $this->data['file_error_key'] = str_replace('</p>','',$this->data['file_error_key']);
                            }
                            $response["status"]  = "error";
                            $response["message"] = $this->data['file_error_key'];
                        } 
                        echo json_encode($response);  
                    }
                }
            
            }
            // var_dump($_FILES);die;
        }
    }

?>