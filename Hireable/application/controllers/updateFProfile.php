<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateFProfile extends MY_Controller{
        function __construct(){
        parent::__construct();
        }
        public function index(){
            $this->data['view']       = 'updateFProfile';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Update -'.$this->data['site_title'];

            //loading models
            $this->load->model('Users');
            $this->load->model('Categories');
            $this->load->model('FreelancerCategories');
            $this->load->model('FProfile');
            
            $categories         = $this->Categories->getData()->result();
            $this->data['categories'] = $categories;



            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                
                if($user->role_id == 2)
                {
                    return redirect(site_url('updateCProfile'));
                }
                else
                {
                    if (isset($_POST['submit'])) {
                        $this->form_validation->set_rules('name', 'name', 'required');
                        $this->form_validation->set_rules('categories[]', 'skills', 'required');
                        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
                        $this->form_validation->set_rules('p_description', 'project description', 'required');
                        if ($this->form_validation->run() == true) {
                            $name          = $this->input->post('name');
                            $email         = $this->input->post('email');
                            $categories    = $this->input->post('categories');
                            $p_description = $this->input->post('p_description');

                            $update_data    =   [   'name'              => $name,
                                                    'email'             => $email,
                                                    'updated_profile'   => 1
                                                ];
                                                
                            $profile_data   =   [   'profile_description' => $p_description,
                                                    'user_id'             => $user->user_id
                                                ];
                            
                            foreach ($categories as $category) {
                                $freelancerCategoryData = [
                                        'category_id'   => $category,
                                        'user_id'       => $user->user_id
                                    ];

                                $this->FreelancerCategories->insertRecord($freelancerCategoryData);
                            }

                            $this->FreelancerCategories->insertRecord($freelancerCategoryData);
                        
                            //update users table
                            $where = ['user_id' => $user->user_id];
                            $this->Users->updateData($update_data, $where);

                            //insert profile description in profile table
                            $this->FProfile->insertRecord($profile_data);
                            return redirect(site_url('Freelancer'));
                        } else {
                            $this->data['freelancer_info'] = $user;
                            return $this->load->view('layout', $this->data);
                        }
                    } else {
                        $this->data['freelancer_info'] = $user;
                        return $this->load->view('layout', $this->data);
                    }
                }

            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }
    