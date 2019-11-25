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

                    $whereUserId = [
                        'receiver_id' => $user->user_id
                    ];
    
                    //loading database table freelancer_rating
                    $this->load->model('CommentsClient');
                    $reviews = $this->CommentsClient->getData($whereUserId)->result();
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
                    // if(isset($_POST['submit']))
                        
                    // {
                    //     $this->form_validation->set_rules('review', 'Review', 'required');
                    //     if($this->form_validation->run() == True)
                    //     {
                    //         $review = $this->input->post('review');
                    //         // var_dump($review);die;
                        
                    //         $reviewData = [
                    //             'review' => $review,
                    //             'user_id' => $user->user_id
                    //         ];
    
                    //      //var_dump($reviewData);die;
    
                    //         $this->CommentsClient->insertRecord($reviewData);
                    //         $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                    //         return $this->load->view('layout',$data);
                        
                    //     }
                       
                    //     else {
                    //         return $this->load->view('layout', $data);
                    //     }
                    // }
                    // else
                    //     {
                    //         return $this->load->view('layout',$data);
    
                    //     }

                        if(isset($_POST['file_submit'])){
                            $this->form_validation->set_rules('userfile', 'image', 'required');
                            //if($this->form_validation->run() == True) {
    
                                    $file = $this->upload_file();
                                    if($file){
                                        
                                        $fileData = [
                                            'profile_pic' => $file['file_name'],
                                            'updated_at' => date("Y-m-d H:i:s")
                                        ];
                                        $whereUserID = [
                                            'user_id' => $user->user_id,
                                            
                                        ];
                                        $this->Users->updateData($fileData, $whereUserID );
                                        // var_dump($file_name);die;
                                        $this->session->set_flashdata("profilePicUploaded"," Your profile pic has been uploaded successfully!");
                                    }
                                
                                return $this->load->view('layout',$data);
                            // }
                            // else{
                            //     return $this->load->view('layout',$data);
                            // }
                            
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
