<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class CommentsClients extends MY_Controller{
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
                    redirect(site_url('Freelancer'));                    
                }
                elseif($user->role_id == 2)
                {
                    $data['view'] = 'CProfile';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Profile -'.$data['site_title']; 
                  
                    $data['client_info'] = $user;
                    $this->load->view('layout',$data);
                   
                    //loading database table Client_rating
                    $this->load->model('CommentsClient');
                    $Comment = $this->CommentsClient->getData()->result();
                    $data['review'] =$Comment; 
                    // var_dump($data);die;
                    
                    if(isset($_POST['submit']))
                    
                    {
                        $this->form_validation->set_rules('review', 'Please add your reviews here', 'required');
                    //  var_dump($review);die;
                    if($this->form_validation->run() == True)
                    {
                        $review = $this->input->post('review');
                    
                        $reviewData = [
                            'review' => $review,
                            'user_id' => $user->user_id
                        ];

                        //  var_dump($reviewData);die;

                        $this->CommentsClient->insertRecord($reviewData);
                        $this->session->set_flashdata("reviewInserted","Review inserted successfully!");

                    }
                    else{
                        $this->load->view('layout',$data);
                    }
                }
                else{
                    $this->load->view('layout',$data);
                }
                   
                 };
                
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }
?>