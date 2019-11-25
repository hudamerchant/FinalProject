<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ClientProfileForFreelancers extends MY_Controller{
        public function index($client_user_id = false){
            function __construct(){
                parent::__construct();
            }
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1){

                    $data['view'] = 'ClientProfileForFreelancers';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Client Profile - '.$data['site_title']; 



                    if($client_user_id){
                        $count = 0;
                        $whereUserId = [
                            'user_id' => $client_user_id
                        ];
                        $clientData = $this->Users->getData($whereUserId)->row();
                        $data['clientDetails'][$count]['user_id'] = $clientData->user_id;
                        $data['clientDetails'][$count]['name'] = $clientData->name;
                        $data['clientDetails'][$count]['dob'] = $clientData->dob;
                        $data['clientDetails'][$count]['gender'] = $clientData->gender;
                        $data['clientDetails'][$count]['email'] = $clientData->email;

                        $clientDetails = $data['clientDetails'];

                        foreach($clientDetails as $clientDetail){
                            
                            $data['clientDetail'] = $clientDetail;
                        }

                    }
                    $this->load->model('Comment');
                    $whereClientId = [
                        'receiver_id' => $client_user_id
                    ];
                    $reviews = $this->Comment->getData($whereClientId)->result();
                    //  var_dump($reviews);die;
                    $arr = [];
                    foreach ($reviews as $review) {
                        // echo $review;
                        $arr[] = $review->review;
                    }
                    // var_dump($arr);die;
    
    
                    $data['comment'] = $arr;
    
                    //Client info
                    $data['client_info'] = $user;
                    if(isset($_POST['submit']))
                        
                    {
                        $this->form_validation->set_rules('review', 'Review', 'required');
                        if($this->form_validation->run() == True)
                        {
                            $review = $this->input->post('review');
                            // var_dump($review);die;
                        
                            $reviewData = [
                                'review' => $review,
                                'user_id' => $user->user_id
                            ];
    
                         //var_dump($reviewData);die;
    
                            $this->Comments->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                            return $this->load->view('layout',$data);
                        
                        }
                       
                        else {
                            return $this->load->view('layout', $data);
                        }
                    }
                    else
                        {
                            return $this->load->view('layout',$data);
    
                        }

                    
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