<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class HireFreelancer extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index($bid_user_id = false, $bid_project_id = false , $project_user_id = false)
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

                        if ($bid_user_id && $bid_project_id && $project_user_id) {

                            $this->load->model('Projects');
                            $this->load->model('Users');
                            $this->load->model('AcceptedProjects');
                            
                            $where_freelancer = [
                                'user_id'   => $bid_user_id
                            ];
                            $freelancer_info = $this->Users->getData('ASC', $where_freelancer)->row();

                            $where_client = [
                                'user_id'   => $project_user_id
                            ];
                            $client_info = $this->Users->getData('ASC', $where_client)->row();
                            
                            $Project_status = [
                                        'project_bid_id'    => $bid_project_id,
                                        'status'            => 'Ongoing',
                                        'hired_freelancer'  => $bid_user_id
                                ]; 
                            $bid_accepted = $this->AcceptedProjects->insertRecord($Project_status);
                            if($bid_accepted)
                            {
                                $reciever       = $freelancer_info->email;
                                $sender         = $client_info->email;
                                $subject        = 'Project Agreement';
                                
                                $this->data['view'] = 'hiremail';
                                $this->data['name']   = $freelancer_info->name;

                                $mailContent = $this->load->view('email/email_layout',$this->data, true);
                                
                                $this->sendMail($subject, $mailContent, $reciever, $sender);
                                
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