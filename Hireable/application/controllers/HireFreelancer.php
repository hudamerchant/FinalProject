<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class HireFreelancer extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index($bid_user_id = false, $bid_project_id = false)
        {
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if ($user->role_id == 1) 
                {
                    return redirect(site_url('Freelancer'));
                } 
                elseif ($user->role_id == 2) 
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {

                        if ($bid_user_id && $bid_project_id) {

                            $this->load->model('Projects');
                            $this->load->model('Users');
                            
                            $where_freelancer = [
                                'user_id'   => $bid_user_id
                            ];
                            $user_info = $this->Users->getData('ASC', $where_freelancer)->row();
                            // var_dump($user_info);die;

                            $where = [
                                'project_id'    => $bid_project_id
                            ];
                            
                            $status_update = [
                                'project_status'        => 1 ,
                                'hired_freelancer_id'   => $bid_user_id
                            ];
        
                            $bid_accepted = $this->Projects->updateData($status_update, $where);
                            if($bid_accepted)
                            {
                                $reciever       = $user_info->email;
                                $subject        = 'Project Agreement';
                                $data['name']   = $user_info->name;
                                $mailContent = $this->load->view('email',$data, true);
    
                                $this->sendMail($subject, $mailContent, $reciever);
                                
                                return redirect(site_url('Client/index/'.$bid_project_id));
                            }
                        }
        
                    }
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }