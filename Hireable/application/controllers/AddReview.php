<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddReview extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($receiver_id = false){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if(!$user->updated_profile)
                {
                    return redirect(site_url('updateFProfile'));
                }
                else
                {
                    $this->data['view'] = 'AddReview';
                    $this->data['site_title'] = 'Hireable';
                    $this->data['page_title'] = 'Add Review -'.$this->data['site_title']; 
                    
                    if(isset($_POST['submit']))                        
                    {
                        $this->form_validation->set_rules('review', 'review', 'required');                          
                        if($this->form_validation->run() == True)
                        {
                            $this->load->model('Reviews_Model');
                            $review = $this->input->post('review');                                
                            $rating = $this->input->post('stars');                                
                            $reviewData = [
                            'review' => $review,
                            'sender_id' => $user->user_id,
                            'receiver_id' => $receiver_id,
                            'rating' => $rating
                            ];

                            $this->Reviews_Model->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                            // redirect(site_url('Client')); 
                        }
                        else {
                            $this->load->view('layout', $this->data);
                        }
                    }
                    return $this->load->view('layout',$this->data);
                }  
            }                 
            else
            {
                return redirect(site_url('Login'));
            }
        }           
    }
