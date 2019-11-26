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
            $user   = $this->Users->getData('DESC',$where)->row();
             if($user->profile_pic != ''){
                $this->data['profile_pic'] = $this->data['image_path'].$user->profile_pic;
            }
            if ($user->role_id == 2) {
                if(!$user->updated_profile)
                {
                    return redirect(site_url('updateCProfile'));
                }
                else
                {
                    $this->data['view'] = 'CProfile';
                    $this->data['site_title'] = 'Hireable';
                    $this->data['page_title'] = 'Profile -' . $this->data['site_title'];

                    $whereUserId = [
                        'receiver_id' => $user->user_id
                    ];
    
                    //loading database table freelancer_rating
                    $this->load->model('CommentsClient');//comment
                    $reviews = $this->CommentsClient->getData('DESC',$whereUserId)->result();
                    //  var_dump($reviews);die;
                    $arr = [];
                    foreach ($reviews as $review) {
                        //echo $review;

                        $arr[] = $review->review;
                        $senderId = $review->user_id ;

                        $whereSenderId = [
                            'user_id' => $senderId,
                            
                        ];
                        $sendersData = $this->Users->getData('DESC',$whereSenderId)->result();
                         //var_dump($sendersData);die;
                        foreach ($sendersData as $senderData) {
                            $this->data['senderData'] = $senderData;
                           // var_dump($senderData);die;
                        }
                    }
                  
                    //var_dump($arr);die;
    
                    
                    $this->data['comments'] = $arr;
    
                    //Client info
                    $this->data['client_info'] = $user;
 
                        if(isset($_POST['file_submit'])){
                            // $this->form_validation->set_rules('userfile', 'image', 'required');
                            // //if($this->form_validation->run() == True) {
    
                                    $file = $this->upload_file();\
                                    var_dump( $file);die;
                                    if(isset($file['profile_pic'])){
                                        
                                        $fileData = [
                                            'profile_pic' => $file['file_name'],
                                            'updated_at' => date("Y-m-d H:i:s")
                                        ];
                                        $whereUserID = [
                                            'user_id' => $user->user_id,
                                        ];
                                        $this->Users->updateData($fileData, $whereUserID );
                                        $this->session->set_flashdata("profilePicUploaded"," Your profile pic has been uploaded successfully!");
                                        // var_dump($file_name);die;
                                    }else{

                                    }
                                
                                return $this->load->view('layout',$this->data);
                            // }
                            // else{
                            //     return $this->load->view('layout',$this->data);
                            // }
                            
                        }
                        else
                        {
                            return $this->load->view('layout',$this->data);
    
                        }
                    
                   // $this->load->view('layout', $this->data);
                }
                
            } elseif ($user->role_id == 2) {
                return redirect(site_url('Client'));
            }
        } else {
            return redirect(site_url('Login'));
        }
    }
}
