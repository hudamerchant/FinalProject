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
            $data['view'] = 'ViewMoreBids';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'View Bids - '.$data['site_title'];
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
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
                            $this->load->model('ProjectBid');
                            $where = [
                                'user_id'       => $bid_user_id,
                                'project_id'    => $bid_project_id
                            ];
                            
                            $status_update = [
                                'status' => 1
                            ] ;
        
                            $accept_bid = $this->ProjectBid->updateData($status_update, $where);
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