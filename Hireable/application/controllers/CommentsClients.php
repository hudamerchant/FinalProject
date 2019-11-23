<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommentsClients extends MY_Controller
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

            if ($user->role_id == 1) {
                return redirect(site_url('Freelancer'));
            } elseif ($user->role_id == 2) {
                if(!$user->updated_profile)
                {
                    return redirect(site_url('updateCProfile'));
                }
                else
                {
                    // die('abcd');
                    $this->data['view'] = 'CProfile';
                    $this->data['site_title'] = 'Hireable';
                    $this->data['page_title'] = 'Profile -' . $this->data['site_title'];

                    $this->data['client_info'] = $user; 

                    //loading database table freelancer_rating
                    $this->load->model('CommentsClient');
                    $reviews = $this->CommentsClient->getData()->result();
                    //  var_dump($reviews);die;

                    foreach ($reviews as $review) {
                        // echo $review;
                        $arr[] = $review->review;
                    }
                    // var_dump($arr);die;


                    $this->data['comments'] = $arr;
                    // var_dump($this->data['comments']);die;

                    if (isset($_POST['submit'])) {

                        $this->form_validation->set_rules('review', 'Please add your reviews here', 'required');
                        // var_dump($review);die;
                        if ($this->form_validation->run() == True) {
                            $review = $this->input->post('review');
                            // var_dump($review);die;
                            $reviewData = [
                                'review' => $review,
                                'user_id' => $user->user_id
                            ];

                            // var_dump($reviewData);die;
                        
                            $this->CommentsClient->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted", "Review inserted successfully!");
                            //  $this->load->view('layout', $this->data);
                        } else {
                            return $this->load->view('layout', $this->data);
                        }
                    } else {
                        return $this->load->view('layout', $this->data);
                    }   
                }
            }
        } else {
            return redirect(site_url('Login'));
        }
    }
}
