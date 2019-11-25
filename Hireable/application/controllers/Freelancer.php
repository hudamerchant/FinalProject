<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Freelancer extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){ 
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if($user->role_id == 1)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $this->data['view']       = 'FDashboard';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Dashboard -'.$this->data['site_title'];
                        
                        $this->load->model('ProjectBid');
                        $whereUserId = [
                            'user_id' => $user->user_id
                        ];
                        $userBids = $this->ProjectBid->getData('DESC',$whereUserId)->result();
                        
                        if($userBids){
                            $this->session->set_flashdata("freelancerBidsPresent",true);
                                $whereUserId = [
                                    'project_bids.user_id' => $user->user_id
                                ];
                                
                                $this->load->model('Projects');
                                
                                $fetchingProjects []= ['table_name'=>'project_bids', 'column_with'=>'project_bids.project_id = projects.project_id']; 
                                $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'projects.user_id = users.user_id']; 
                                
                                $selectArray = [
                                    'project_bids'.'.user_id', 
                                    'project_bids'.'.project_id',                           
                                    'projects'.'.project_title',                            
                                    'users'.'.name',
                                    'users'.'.email',
                                    'projects'.'.updated_at'
                                ];
    
                                $results = $this->Projects->multiple_joins($fetchingProjects,$whereUserId,$selectArray , 'DESC')->result();
                                
                                $this->data['results'] = $results; 
                        }
                            
                        
                        $this->load->view('layout',$this->data);
                        $this->data['page_title'] = 'Dashboard -'.$this->data['site_title'];
    
                        return $this->load->view('layout',$this->data);
                    }
                    
                }
                elseif($user->role_id == 2)
                {
                    return redirect(site_url('Client'));
                }
                return $this->load->view('layout',$this->data);
            }
            else
            {
                return redirect(site_url('Login'));
            }

        }
    }