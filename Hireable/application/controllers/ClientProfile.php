<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ClientProfile extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->model('Users');
        if ($this->session->userdata('logged_in')) {
            $where  = ['email' => $this->session->userdata('user_info')];
            $user   = $this->Users->getData($where)->row();
            if ($user->role_id == 2) {
                $data['view'] = 'CProfile';
                $data['site_title'] = 'Hireable';
                $data['page_title'] = 'Profile -' . $data['site_title'];

                //loading database table freelancer_rating
                $this->load->model('CommentsClient');
                $reviews = $this->CommentsClient->getData()->result();
                //  var_dump($reviews);die;
                $arr = [];
                foreach ($reviews as $review) {
                    // echo $review;
                    $arr[] = $review->review;
                }
                // var_dump($arr);die;


                $data['comments'] = $arr;

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

                        $this->CommentsClient->insertRecord($reviewData);
                        $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                        $this->load->view('layout',$data);
                    
                    }
                   
                    else {
                        $this->load->view('layout', $data);
                    }
                }
                else
                    {
                        $this->load->view('layout',$data);

                    }
               // $this->load->view('layout', $data);
            } elseif ($user->role_id == 2) {
                redirect(site_url('Client'));
            }
        } else {
            redirect(site_url('Login'));
        }
    }
}
