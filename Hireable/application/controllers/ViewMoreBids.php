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
                $user   = $this->Users->getData($where)->row();
                
                if($user->role_id == 1)
                {       
                    redirect(site_url('Freelancer'));                    
                }
                elseif($user->role_id == 2)
                {                    
                    $data['view'] = 'ViewMoreBids';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'View Bids - '.$data['site_title'];
                    $this->load->model('Projects');
                    $projects = $this->Projects->getData()->result(); 
                    
                    if($projects){

                        $count = 0;
                        $this->session->set_flashdata("projectsPresent",true);
                        foreach ($projects as $project) {
                            $data['projects'][$count]['project_id'] = $project->project_id;
                            
                        }
                        
                            if($project_apply_id){
                                
                                $data['project_apply_id'] = $project_apply_id;
                                $this->load->model('ProjectBid');
                                $whereBid = [
                                    'project_id' => $project_apply_id
                                ];
                                $project_bids = $this->ProjectBid->getData($whereBid)->result();

                                if($project_bids){
                                    $this->session->set_flashdata("projectsBidsPresent",true);
                                    foreach ($project_bids as $project_bid) {
                                        $data['data_project_bids'][$count]['bid_user_id']= $project_bid->user_id;
                                        $data['data_project_bids'][$count]['bid_project_id']= $project_bid->project_id;
                                        
                                        //var_dump($data['project_bids']);
                                        $whereUserId = [
                                            'user_id' => $project_bid->user_id
                                        ];
                                        $userData = $this->Users->getData($whereUserId)->row();
                                        // var_dump($userData->name);
                                        $data['data_project_bids'][$count]['bid_username']      = $userData->name;
                                        $count++;
                                        
                                        $data['data_project_bids'][$count]['bid_username'] = $userData->name;
                                        $count++;                                        
                                    }
                                }                              
                                
                            }else{
                                redirect('Client');
                            }
                    }
                    $this->load->view('layout',$data);
                }
            }
        }
    }