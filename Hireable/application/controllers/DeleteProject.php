<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class DeleteProject extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index($project_id = false)
        {
            $this->data['view']       = 'DeleteProject';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Delete Project - '.$this->data['site_title'];
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('',$where)->row();
                // var_dump($this->db->last_query());die;
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
                        // var_dump($this->db->last_query());die;
                        if ($project_id) {
                            $this->load->model('Projects');
                            $dataToUpdate = [
                                'deleted_at' => date("Y-m-d H:i:s")
                            ];
                            $whereProjectID = [
                                'project_id' => $project_id
                            ];
                            $this->Projects->updateData($dataToUpdate,$whereProjectID);
                            // var_dump($this->db->last_query());die;
                            return redirect(site_url('Client'));
                        }
                        return $this->load->view('layout',$this->data);

        
                    }
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }