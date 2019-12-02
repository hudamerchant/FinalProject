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

            $this->data['view']       = 'EditProject';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Edit Project - '.$this->data['site_title'];

            $this->load->model('Users');

            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if ($user->role_id == 1) {
                    return redirect(site_url('Freelancer'));
                } elseif ($user->role_id == 2) {
                    if (!$user->updated_profile) {
                        return redirect(site_url('updateCProfile'));
                    } else {
                        //loading database table categories
                        $this->load->model('Categories');
                        $categories         = $this->Categories->getData('DESC')->result();
                        $this->data['categories'] = $categories;

                        if ($project_id) {
                            $this->data['project_data']['project_id'] = $project_id;
                            $this->load->model('Projects');
                            // $whereProjectId = [
                            //     'project_id' => $project_id
                            // ];
                            // $project = $this->Projects->getData($whereProjectId)->row();
                            // $this->data['project']['project_title'] = $project->project_title;
                            // $this->data['project']['project_description'] = $project->project_descript;
                            $whereProjectId = [
                                'projects.project_id' => $project_id
                            ];
                            $fetchingProjects []= [
                                'table_name'=>'project_category',
                                'column_with'=>'project_category.project_id = projects.project_id'
                            ];
                            $fetchingProjects []= [
                                'table_name'=>'categories',
                                'column_with'=>'project_category.category_id = categories.category_id'
                            ];
                            
                            $selectArray = [
                                
                                'project_category.project_category_id',
                                'projects.project_title',
                                'projects.project_descript',
                                'categories.category',
                                'categories.category_id',
                                'project_category.deleted_at',
                            ];
                            $results = $this->Projects->multiple_joins(
                                $fetchingProjects,
                                $whereProjectId,
                                $selectArray,
                                "DESC",
                                "projects.updated_at"
                            )->result();
                            // $project_categories = [];
                            foreach ($results as $result) {
                                $this->data['project_data']['project_title'] = $result->project_title;
                                $this->data['project_data']['project_description'] = $result->project_descript;
                                if($result->deleted_at == null)
                                {
                                    $this->data['project_data']['categories'][$result->category_id] = $result->category;
                                }
                                // $category_ids[] = $result->category_id;
                                // $project_category_ids[] = $result->project_category_id;
                                // $this->data['project_data']['categoryDetails']['project_categories'][] = $result->category;
                                // var_dump($this->data['project_data']['categoryDetails']['category_id'][$count]);                                $count++;
                                // var_dump($this->data['project_data']['categoryDetails']['project_categories'][$count]);
                            }
                            if (isset($_POST['submit'])) {
                                $this->form_validation->set_rules('project-title', 'project title', 'required');
                                $this->form_validation->set_rules('project-description', 'project description', 'required');
                                $this->form_validation->set_rules('categories[]', 'skills', 'required');

                                if ($this->form_validation->run() == true) {
                                    $project_title       = $this->input->post('project-title');
                                    $project_description = $this->input->post('project-description');
                                    $categoriesInput     = $this->input->post('categories[]');
                                    $this->load->model('Projects');
                                    $projectData = [
                                        'project_id'        => $project_id,
                                        'project_title'     => $project_title,
                                        'project_descript'  => $project_description,
                                        'user_id'           => $user->user_id,
                                        'updated_at'        => date("Y-m-d H:i:s")
                                    ];
                                    $whereProjectId = [
                                        'project_id' => $project_id
                                    ];
                                    $this->Projects->updateData($projectData, $whereProjectId);
                                
                                    $this->load->model('ProjectCategories');
    
                                    foreach ($categoriesInput as $categoryInput) {
        
                                        $projectCategoryData = [
                                            'category_id' => $categoryInput,
                                            'project_id' => $project_id
                                        ];

                                        $this->ProjectCategories->insertRecord($projectCategoryData);

                                    }
                                    
                                    return redirect(site_url('Client_dashboard'));
                                }
                                else {
                                    return $this->load->view('layout', $this->data);
                                }
                            }
                            else {
                                return $this->load->view('layout', $this->data);
                            }
                        } else {

                            return $this->load->view('layout', $this->data);
                        }
                    } 
                }             
            } else {
                return redirect(site_url('Login'));
            }
                        
        }
        public function deleteProject() {

            $this->load->model('Users');
            $this->load->model('ProjectCategories');

            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC', $where)->row();
                if ($user->role_id == 1) {
                    return redirect(site_url('Freelancer'));
                }
                elseif($user->role_id == 2)
                {
                    $response = [];
                    $project_id     = $_POST['project_id'];
                    $category_id    = $_POST['category_id'];
        
                    if(isset($project_id) && isset($category_id))
                    {
                        $delete = [
                            'deleted_at' => date("Y-m-d H:i:s")
                        ];
                        $where = [
                            'project_id'    => $project_id,
                            'category_id'   => $category_id
                        ];
                        $result_set = $this->ProjectCategories->updateData($delete ,$where);
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