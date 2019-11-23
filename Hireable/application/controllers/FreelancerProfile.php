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
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1)
                {        
                    $data['view'] = 'FProfile';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Profile -'.$data['site_title']; 

                    //Freelancer info
                   // $data['freelancer_info'] = $user;

                    $this->load->model('Comment');
                    $reviews = $this->Comment->getData()->result();
                    // $data['review'] =$Comment; 
                     //var_dump($this->data);die;
                     $arr = [];
                    foreach ($reviews as $review) {
        
                        $arr[] = $review->review;
                    }
                    //var_dump($arr);die;

                    $data['comment'] = $arr;

                    $data['freelancer_info'] = $user;
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
    
                            $this->Comment->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted","Review inserted successfully!");

                        
                        }
                       
                        else {
                            $this->load->view('layout', $data);
                        }
                    }
                    else
                    {
                        $this->load->view('layout',$data);

                    }
                    // var_dump($review);die;
                    
                    // if($user->updated_profile == 0)
                    // {
                    //     return redirect(site_url('updateFProfile'));
                    // }
                    // else
                    // {
                    //     $this->load->view('layout',$data);
                    // }
                    
                }
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client'));
                }
                $this->load->view('layout',$data);
            }
            else
            {
                redirect(site_url('Login'));
            }
            

        }
    }

?>