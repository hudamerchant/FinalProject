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
    
                    //loading reviews
                    $this->load->model('Reviews_Model');
                    $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'reviews.sender_id = users.user_id']; 
                    $whereUserId = [
                        'receiver_id' => $user->user_id
                    ];
                    $selectArray = [
                        'reviews.sender_id',
                        'reviews.receiver_id',
                        'reviews.rating',
                        'reviews.review',
                        'reviews.updated_at',
                        'users.user_id',
                        'users.name',
                        'users.email',
                        'users.profile_pic'
                    ];
                    $reviewResults = $this->Reviews_Model->multiple_joins($fetchingProjects,$whereUserId,$selectArray, 'DESC','reviews.updated_at')->result();
                    // var_dump($reviewResults);die;
                    $this->data['reviewResults'] = $reviewResults;
                    
                    //Client info
                    $this->data['client_info'] = $user;

                    $this->load->model('CProfile');
                    $whereClientId       =   [  
                        'user_id'         => $user->user_id
                    ];
                    $gettingClientProfileData = $this->CProfile->getData('DESC',$whereClientId)->row();
                    if($gettingClientProfileData != null){
                        $this->data['orgDescription'] = $gettingClientProfileData->org_description;
                        // var_dump($this->data['orgDescription']);die;
                    }
                    
                    return $this->load->view('layout',$this->data);

                }                
            } 
            elseif($user->role_id == 2) 
            {
                return redirect(site_url('Client'));
            }
        } 
        else 
        {
            return redirect(site_url('Login'));
        }
    }
    public function upload(){
        $this->load->model('Users');
        if ($this->session->userdata('logged_in')) {
            $where  = ['email' => $this->session->userdata('user_info')];
            $user   = $this->Users->getData('DESC', $where)->row();
        
            if ($user->role_id == 1) {
                return redirect(site_url('Freelancer'));
            } elseif ($user->role_id == 2) {
                if (!$user->updated_profile) {
                    return redirect(site_url('updateCProfile'));
                } else {
                    $user_file = 'file_name';
                    $file = $this->upload_file($user_file);
                    if(isset($file['file_name']))
                    {    
                        $fileData = [
                            'profile_pic' => $file['file_name'],
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $whereUserID = [
                            'user_id' => $user->user_id,
                        ];
                        $this->Users->updateData($fileData, $whereUserID );
                        $this->session->set_flashdata("profilePicUploaded"," Your profile pic has been uploaded successfully!");
                    }else{
                        $this->data['file_error_key'] = $file;
                    }  
                }
            }
        
        }
        // var_dump($_FILES);die;
    }
}
