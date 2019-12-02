<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Client_dashboard extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($bid_project_id = false){ 
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){

                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();

                if($user->role_id == 2)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('Update_client_profile'));
                    }
                    else
                    {
                        $this->data['view']       = 'client_dashboard';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Dashboard -'.$this->data['site_title'];      
                        
                        $this->load->model('Projects');
                        $this->load->model('AcceptedProjects');
                        $this->load->model('ProjectBid');
                        
                        $fetchingProjects []= [
                            'table_name'=>'accepted_projects',
                            'column_with'=>'projects.project_id = accepted_projects.project_id'
                        ];
                        $select = [
                            'projects.project_id',
                            'projects.project_title',
                            'projects.project_descript',
                            'projects.user_id',
                            'projects.created_at',
                            'projects.deleted_at',
                            'projects.updated_at',
                            'accepted_projects.accepted_project_id',
                            'accepted_projects.status',
                            'accepted_projects.hired_freelancer'
                        ];
                        $projects = $this->Projects->multiple_joins($fetchingProjects,[] , $select, "DESC", "projects.updated_at" , 'left')->result(); 
                        // var_dump($projects);die;
                    
                        $count = 0;
                        if($projects){
                            
                            $this->session->set_flashdata("projectsPresent",true);
                            foreach ($projects as $project) {
                                $where      = ['user_id' => $project->hired_freelancer ];
                                $freelancer = $this->Users->getData('DESC',$where)->row();

                                $category_id = [];
                                $this->data['projects'][$count]['title']            = $project->project_title;
                                $this->data['projects'][$count]['description']      = $project->project_descript;
                                $this->data['projects'][$count]['project_id']       = $project->project_id;
                                $this->data['projects'][$count]['bid_status']       = $project->status;

                                if(isset($freelancer))
                                {
                                    $this->data['projects'][$count]['hired_freelancer'] = $freelancer->name;
                                }
                                $this->load->model('ProjectCategories');
                                $projectCategoryWhere = [
                                    'project_id' => $project->project_id
                                ];
                                $categoryVariable = $this->ProjectCategories->getData('DESC',$projectCategoryWhere)->result();
                                
                                    foreach ($categoryVariable as $categoryVariable2) {
                                        $category_id[] =    $categoryVariable2->category_id;
                                    }

                                    $this->load->model('Categories');
                                    $categories = $this->Categories->getDataWhereIn("category_id",$category_id)->result(); 
                                    
                                    foreach ($categories as $category) {
                                        $this->data['projects'][$count]['categories'][] = $category->category;
                                    }
                                
                                
                                $count++;
                            }
                            
                        }
                        
                        return $this->load->view('layout',$this->data);
                    }
                }
                elseif($user->role_id == 1)
                {
                    return redirect(site_url('Freelancer'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }