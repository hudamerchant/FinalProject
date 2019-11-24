<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class EditProject extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index($project_id = false)
        {
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
                        $data['view']       = 'EditProject';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'Edit Project - '.$data['site_title'];

                        //loading database table categories
                        $this->load->model('Categories');
                        $categories         = $this->Categories->getData()->result();
                        $data['categories'] = $categories; 

                        if($project_id){
                            $this->load->model('Projects');
                            // $whereProjectId = [
                            //     'project_id' => $project_id
                            // ];
                            // $project = $this->Projects->getData($whereProjectId)->row();
                            // $data['project']['project_title'] = $project->project_title;
                            // $data['project']['project_description'] = $project->project_descript;
                            $whereProjectId = [
                                'projects.project_id' => $project_id
                            ];
                            $fetchingProjects []= ['table_name'=>'project_category', 'column_with'=>'project_category.project_id = projects.project_id']; 
                            $fetchingProjects []= ['table_name'=>'categories', 'column_with'=>'project_category.category_id = categories.category_id']; 
                            
                            $selectArray = ['projects'.'.project_title', 
                                'projects'.'.project_descript',                           
                                'categories'.'.category',                                                  
                                'categories'.'.category_id'                                                  
                            ];
                            $results = $this->Projects->multiple_joins($fetchingProjects,$whereProjectId,$selectArray)->result();
                            // $count=0;
                            // $project_categories = [];
                            foreach ($results as $result) {
                                $data['project_data']['project_title'] = $result->project_title;
                                $data['project_data']['project_description'] = $result->project_descript;
                                $data['project_data']['categoryDetails']['category_id'][] = $result->category_id;
                                $data['project_data']['categoryDetails']['project_categories'][] = $result->category;
                                // var_dump($data['project_data']['categoryDetails']['category_id'][$count]);                                $count++;
                                // var_dump($data['project_data']['categoryDetails']['project_categories'][$count]);                                $count++;
                            }

                            if(isset($_POST['submit'])){
    
                                $this->form_validation->set_rules('project-title', 'project title', 'required');
                                $this->form_validation->set_rules('project-description', 'project description', 'required');
                                $this->form_validation->set_rules('categories[]', 'skills', 'required');

                                if($this->form_validation->run() == True) {
    
                                    $project_title = $this->input->post('project-title');
                                    $project_description = $this->input->post('project-description');                            
                                    $categoriesInput[] = $this->input->post('categories');
                                    
                                    $this->load->model('Projects');
        
                                    $projectData = [
                                        'project_id' => $project_id,
                                        'project_title' => $project_title,
                                        'project_descript' => $project_description,
                                        'user_id' => $user->user_id,
                                        'updated_at' => date("Y-m-d H:i:s")
                                    ];
                                    $whereProjectId = [
                                        'project_id' => $project_id
                                    ];
                                     $this->Projects->updateData($projectData,$whereProjectId);
                                     $last_inserted_id = $this->db->insert_id();

                                     $this->load->model('ProjectCategories');
    
                                    foreach ($categoriesInput as $categoryInput) {
                                        
                                        foreach ($categoryInput as $value) {
                                            var_dump($value);
                                            $projectCategoryData = [
                                                'category_id' => $value,
                                                'project_id' => $project_id,
                                                'updated_at' => date("Y-m-d H:i:s")
                                            ];
        
                                            $this->ProjectCategories->updateData($projectCategoryData,$whereProjectId);
        
                                        }
        
                                    }
                                    
                                }
                            }    
                            
                        }

                        return $this->load->view('layout',$data);
                    }
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }