<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddReview extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($id = false){
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
                        $data['view'] = 'AddReview';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'AddFreelancerReview -'.$data['site_title']; 
                   
                        //Client info
                        $data['freelancer_info'] = $user;
                        $this->load->model('Comment');

                        if(isset($_POST['submit']))
                    
                        {
                            $this->form_validation->set_rules('review', 'review', 'required');
                    
                        if($this->form_validation->run() == True)
                        {
                            $review = $this->input->post('review');
                        
                            $reviewData = [
                                'review' => $review,
                                'user_id' => $user->user_id,
                                'receiver_id' => $id,
                                'rating' => $_POST['stars']
                            ];
    
                            $this->Comment->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                            redirect(site_url('Client')); 
                        }
                        
                       
                        else {
                            $this->load->view('layout', $data);
                        }
                    }


                        return $this->load->view('layout',$data);
                    }
                   
                }
                elseif($user->role_id == 2)
                {
                    $data['view'] = 'AddReview';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'AddReview -'.$data['site_title']; 

                    //Client info
                    $data['client_info'] = $user;
                    $this->load->model('CommentsClient');

                    if(isset($_POST['submit']))
                
                    {
                        $this->form_validation->set_rules('review', 'review', 'required');
                    
                    if($this->form_validation->run() == True)
                    {
                        $review = $this->input->post('review');
                    
                        $reviewData = [
                            'review' => $review,
                            'user_id' => $user->user_id,
                            'receiver_id' => $id,
                            'rating' => $_POST['stars']
                        ];

                        $this->CommentsClient->insertRecord($reviewData);
                        $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                        redirect(site_url('Freelancer'));   
                    }
                   
                    else {
                        
                        $this->load->view('layout', $this->data);
                    }
                }


                    return $this->load->view('layout',$data);
                }
                }
                 
            else
            {
                return redirect(site_url('Login'));
            }
            }
           
        }
?>