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
                if(!$user->updated_profile)
                {
                    return redirect(site_url('updateCProfile'));
                }
                else
                {
                    $data['view'] = 'CProfile';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Profile -' . $data['site_title'];

                    if(isset($_POST['file_submit'])){
                        if(isset($_FILES['userfile'])){

                            var_dump($_FILES['userfile']);
                            $file = $this->upload_file();
                            if($file){
                                var_dump(base_url().'assets/uploads/');
                                var_dump($file);die;
                            }
                        }
                        
                    }
    
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
                    
                   // $this->load->view('layout', $data);
                }
                
            } elseif ($user->role_id == 2) {
                return redirect(site_url('Client'));
            }
        } else {
            return redirect(site_url('Login'));
        }
    }
}
