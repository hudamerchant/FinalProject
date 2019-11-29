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
            
            $categories         = $this->Categories->getData('DESC')->result();
            $this->data['categories'] = $categories;



            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC' ,$where)->row();
                
                if($user->role_id == 2)
                {
                    return redirect(site_url('updateCProfile'));
                }
                else
                {
                    $this->load->model('Categories');
                    $this->load->model('FreelancerCategories');
                    $categories         = $this->Categories->getData('DESC')->result();
                    $this->data['categories'] = $categories;

                    $where = [
                        'users.user_id' => $user->user_id
                    ];
                    $fetching []= [
                        'table_name'=>'freelancer_category',
                        'column_with'=>'freelancer_category.user_id = users.user_id'
                    ];
                    $fetching []= [
                        'table_name'=>'categories',
                        'column_with'=>'freelancer_category.category_id = categories.category_id'
                    ];
                    $fetching []= [
                        'table_name'=>'freelancer_profile',
                        'column_with'=>'freelancer_profile.user_id = users.user_id'
                    ];
                    $selectArray = [
            
                        'freelancer_category.freelancer_category_id',
                        'users.name',
                        'users.email',
                        'categories.category',
                        'categories.category_id',
                        'freelancer_profile.profile_description',
                        'freelancer_category.deleted_at',
                    ];
                    $results = $this->Users->multiple_joins(
                        $fetching,
                        $where,
                        $selectArray,
                        "DESC",
                        "freelancer_category.updated_at"
                    )->result();
                    foreach ($results as $result) {
                        $this->data['freelancer_info']['id'] = $user->user_id;
                        $this->data['freelancer_info']['name'] = $result->name;
                        $this->data['freelancer_info']['email'] = $result->email;
                        $this->data['freelancer_info']['profile_description'] = $result->profile_description;
                        if ($result->deleted_at == null) {
                            $this->data['freelancer_info']['categories'][$result->category_id] = $result->category;
                        }
                    }

                    $this->data['freelancer_info']['id'] = $user->user_id;
                    $this->data['freelancer_info']['name'] = $user->name;
                    $this->data['freelancer_info']['email'] = $user->email;

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
                            
                            $this->FProfile->insertRecord($profile_data);
                        
                            //update users table
                            $where = ['user_id' => $user->user_id];
                            $this->Users->updateData($update_data, $where);

                            //insert profile description in profile table
                            $this->FProfile->updateData($profile_data,$where);
                            return redirect(site_url('Freelancer'));
                            
                        } else {
                            // $this->data['freelancer_info'] = $user;
                            return $this->load->view('layout', $this->data);
                        }
                    } else {
                        //Rida ka kaam, don't remove, yahan se

                        // $where = [
                        //     'user_id'=> $user->user_id
                        // ];
                        // $RetrievingProfileDescription = $this->FProfile->getData('DESC',$where)->result();
                        // foreach($RetrievingProfileDescription as $ProfileDescription){

                        //     var_dump($ProfileDescription->profile_description);
                        // }

                        //yahan tk
                            
                        return $this->load->view('layout', $this->data);
                    }
                    // return $this->load->view('layout', $this->data);
                }

            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
        public function deleteProject() {

            $this->load->model('Users');
            $this->load->model('FreelancerCategories');

            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC', $where)->row();
                if ($user->role_id == 2) {
                    return redirect(site_url('Client'));
                }
                elseif($user->role_id == 1)
                {
                    $response = [];
                    $freelancer_id  = $_POST['freelancer_id'];
                    $category_id    = $_POST['category_id'];
        
                    if(isset($freelancer_id) && isset($category_id))
                    {
                        $delete = [
                            'deleted_at' => date("Y-m-d H:i:s")
                        ];
                        $where = [
                            'user_id'       => $freelancer_id,
                            'category_id'   => $category_id
                        ];
                        $result_set = $this->FreelancerCategories->updateData($delete ,$where);
                        if($result_set)
                        {
                            $response = [
                                'msg' => 'Skill Deleted Successfully'
                            ];
                        }
                    }
        
                    echo json_encode($response);
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
            
        }
    }
    