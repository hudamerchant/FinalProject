<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateCProfile extends MY_Controller{
        function __construct(){
            parent::__construct();
            }
        public function index(){
            $this->data['view']       = 'updateCProfile';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Update - '.$this->data['site_title'];
             //loading models
             $this->load->model('Users');
             $this->load->model('CProfile');
             
             if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC' ,$where)->row();
                if($user->role_id == 1)
                {
                    return redirect(site_url('updateFProfile'));
                }
                else
                {
                    if(isset($_POST['submit']))
                    {
                        $this->form_validation->set_rules('name', 'name', 'required');
                        $this->form_validation->set_rules('dob', 'dob', 'required');
                        $this->form_validation->set_rules('gender', 'gender', 'required');
                        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                        if($this->form_validation->run() == True) {
    
                            $name               = $this->input->post('name');
                            $dob                = $this->input->post('dob');
                            $gender             = $this->input->post('gender');
                            $email              = $this->input->post('email');
                            $org_description    = $this->input->post('org_description');
    
                            $update_data    =   [   'name'              => $name,
                                                    'dob'               => $dob,
                                                    'gender'            => $gender,                        
                                                    'email'             => $email,
                                                    'updated_profile'   => 1
                                                ];
    
                            if (!empty($org_description)) {
                                $org_data       =   [   'org_description' => $org_description,
                                                        'user_id'         => $user->user_id
                                                    ];
                                //insert organization description in profile table
                                $this->CProfile->insertRecord($org_data);
                            }
                            
                            $where = ['user_id' => $user->user_id];
                            $this->Users->updateData($update_data , $where);
                            
                            return redirect(site_url('Client'));
    
                        }
                        else
                        {
                            $this->data['client_info'] = $user;
                            return $this->load->view('layout',$this->data);
                        }
                    }
                    else
                    {
                        $this->data['client_info'] = $user;
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

?>