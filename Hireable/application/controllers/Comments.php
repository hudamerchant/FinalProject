<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Comments extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){

                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();

                if($user->role_id == 2)
                {       
                    redirect(site_url('Client'));                    
                }
                elseif($user->role_id == 1)
                {
                    $data['view'] = 'FProfile';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Profile -'.$data['site_title']; 
                  
                    $data['freelancer_info'] = $user;
                    $this->load->view('layout',$data);
                   
                    //loading database table 
                    $this->load->model('Comment');
                    $Comment = $this->Comment->getData()->result();
                    $data['review'] =$Comment; 
                    //  var_dump($data);die;
                    
                    if(isset($_POST['submit']))
                    
                    {
                        $this->form_validation->set_rules('review', 'Please add your reviews here', 'required');
                    }
                    // var_dump($review);die;
                    if($this->form_validation->run() == True)
                    {
                        $review = $this->input->post('review');
                        // var_dump($review);die;
                    
                        $reviewData = [
                            'review' => $review,
                            'user_id' => $user->user_id
                        ];

                        // var_dump($reviewData);die;

                        $this->Comment->insertRecord($reviewData);

                        // foreach ($reviewData as $reviews)
                        // {
                        //     //  var_dump($reviews);die;
                        //     $review1 = [
                        //         'review' => $reviews
                        //     ];
                        //     $this->Comment->insertRecord($review1);
                        //     // var_dump($review1);
    
                        // };
                    
                    };
                    $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                    
                 };
            }
        }
    }
?>