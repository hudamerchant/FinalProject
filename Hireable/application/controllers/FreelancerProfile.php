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
                    // $this->session->set_flashdata("profilePicPresent",true);
                    // var_dump($user->profile_pic);die;
                    $this->data['profile_pic'] = $this->data['image_path'].$user->profile_pic;
                }
                // var_dump($data['profile_pic']);die;
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
                        $this->data['page_title'] = 'Profile -'.$this->data['site_title']; 

                        $this->load->model('CommentsClient');
                        $whereUserId = [
                            'receiver_id' => $user->user_id
                        ];
                        $reviews = $this->CommentsClient->getData('DESC',$whereUserId)->result();
                        // $this->data['review'] =$Comment; 
                        //var_dump($this->data);die;
                        $arr = [];
                        foreach ($reviews as $review) {
            
                            $arr[] = $review->review ;
                            $senderId = $review->user_id ;

                            $whereSenderId = [
                                'user_id' => $senderId,
                                
                            ];
                            $sendersData = $this->Users->getData('DESC',$whereSenderId)->result();
                            // var_dump($sendersData);die;
                            foreach ($sendersData as $senderData) {
                                $this->data['senderData'] = $senderData;
                                // var_dump($senderData);
                            }
                           
                        }
                        

                        $this->data['comment'] = $arr;

                        $this->data['freelancer_info'] = $user;
                        $this->load->model('FCategories');
                        $fetchingProjects []= ['table_name'=>'categories', 'column_with'=>'freelancer_category.category_id = categories.category_id']; 
                        $whereUserID = [
                            'user_id' => $user->user_id
                        ];
                        $selectArray = [
                            'freelancer_category'.'.updated_at',
                            'categories'.'.category' 
                                ];
                        $results = $this->FCategories->multiple_joins($fetchingProjects,$whereUserID,$selectArray,'DESC')->result();
                        $this->data['results'] = $results;
                        
                        // foreach($results as $result){

                        //     var_dump($result->category);
                        // }


                       
                        if(isset($_POST['file_submit'])){
                            // $this->form_validation->set_rules('userfile', 'image', 'required');
                            // if($this->form_validation->run() == True) {
    
                                    $file = $this->upload_file();
                                    if($file){
                                        
                                        $fileData = [
                                            'profile_pic' => $file['file_name'],
                                            'updated_at' => date("Y-m-d H:i:s")
                                        ];
                                        $whereUserID = [
                                            'user_id' => $user->user_id,
                                            
                                        ];
                                        $this->Users->updateData($fileData, $whereUserID );
                                        // var_dump($file_name);die;
                                        $this->session->set_flashdata("profilePicUploaded"," Your profile pic has been uploaded successfully!");
                                        return redirect(site_url('FreelancerProfile'));
                                    }
                                
                                return $this->load->view('layout',$this->data);
                            // }
                            // else{
                            //     return $this->load->view('layout',$this->data);
                            // }
                            
                        }
                        else
                        {
                            return $this->load->view('layout',$this->data);
    
                        }
                        
                        
                    
                        // $this->load->view('layout',$this->data);
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
    }

?>