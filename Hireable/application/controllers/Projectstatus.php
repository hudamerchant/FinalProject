<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Projectstatus extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index($project_id = false , $status = false)
        {
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC', $where)->row();

                if ($user->role_id == 1) {
                    return redirect(site_url('Freelancer'));
                }
                elseif ($user->role_id == 2)
                {
                    $this->load->model('AcceptedProjects');
                    $update_status = [
                        'status' => $status
                    ];
                    $where = [
                        'project_id' => $project_id
                    ];
                    $this->AcceptedProjects->updateData($update_status ,$where );
                    
                    return redirect(site_url('Client'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }