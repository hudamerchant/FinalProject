<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ViewMoreBids extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($project_apply_id = false){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){

                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC' ,$where)->row();
                
                if($user->role_id == 1)
                {       
                    redirect(site_url('Freelancer'));                    
                }
                elseif($user->role_id == 2)
                {                    
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        $this->data['view'] = 'ViewMoreBids';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'View Bids - '.$this->data['site_title'];
                        $this->load->model('Projects');
                        $projects = $this->Projects->getData('DESC')->result(); 
                        
                        if($projects){
    
                            $count = 0;
                            $this->session->set_flashdata("projectsPresent",true);
                            foreach ($projects as $project) {
                                $this->data['projects'][$count]['project_id'] = $project->project_id;
                                
                            }
                            
                            if($project_apply_id){
                                
                                $this->data['project_apply_id'] = $project_apply_id;
                                $this->load->model('ProjectBid');
                                $whereBid = [
                                    'project_id' => $project_apply_id
                                ];
                                $project_bids = $this->ProjectBid->getData('DESC' ,$whereBid)->result();

                                if($project_bids){
                                    $this->session->set_flashdata("projectsBidsPresent",true);
                                    foreach ($project_bids as $project_bid) {
                                        $this->data['data_project_bids'][$count]['project_user_id']= $user->user_id;
                                        $this->data['data_project_bids'][$count]['bid_user_id']= $project_bid->user_id;
                                        $this->data['data_project_bids'][$count]['bid_project_id']= $project_bid->project_id;
                                        
                                        //var_dump($this->data['project_bids']);
                                        $whereUserId = [
                                            'user_id' => $project_bid->user_id
                                        ];
                                        $userData = $this->Users->getData('DESC' ,$whereUserId)->row();
                                        // var_dump($userData->name);
                                        $this->data['data_project_bids'][$count]['bid_username']      = $userData->name;
                                        $this->data['data_project_bids'][$count]['bid_email']      = $userData->email;
                                        if($userData->profile_pic != ''){
                                            $this->data['data_project_bids'][$count]['profile_pic'] = $this->data['image_path'].$userData->profile_pic;
                                        }
                                        $count++;                                        
                                    }
                                }                              
                                
                            }else{
                                redirect('Client');
                            }
                        }
                        $this->load->view('layout',$this->data);                        
                    }

                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }