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
                    foreach ($reviews as $review) {
        
                        $arr[] = $review->review;
                    }
                    //var_dump($arr);die;

                    $data['comment'] = $arr;

                    $data['freelancer_info'] = $user;
                  //  $this->load->view('layout', $data);


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
            }
            else
            {
                redirect(site_url('Login'));
            }

        }
    }

?>