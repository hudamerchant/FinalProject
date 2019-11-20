<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Client extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){ 
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){

                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();

                if($user->role_id == 2)
                {
                    $data['view']       = 'CDashboard';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Dashboard -'.$data['site_title'];      
                    
                    $this->load->model('Projects');
                    $where = [
                        'user_id' => $user->user_id
                    ];
                    $projects = $this->Projects->getData($where)->result();
                    $count = 0;

                    if($projects){
                        $this->session->set_flashdata("projectsPresent",true);
                        foreach ($projects as $project) {

                            $category_id = [];
                            $data['projects'][$count]['title'] = $project->project_title;
                            $data['projects'][$count]['description'] = $project->project_descript;
                            $data['projects'][$count]['project_id'] = $project->project_id;
                            // var_dump($projects);
                            $this->load->model('ProjectCategories');
                            $projectCategoryWhere = [
                                'project_id' => $project->project_id
                            ];
                            $categoryVariable = $this->ProjectCategories->getData($projectCategoryWhere)->result();
    
                             foreach ($categoryVariable as $categoryVariable2) {
                                 $category_id[] =    $categoryVariable2->category_id;
                            }
                            $this->load->model('Categories');
                            $categories = $this->Categories->getDataWhereIn("category_id",$category_id)->result(); 
                            foreach ($categories as $category) {
                                $data['projects'][$count]['categories'][] = $category->category;
                            }
                            $count++;
                        }
                    }
                    
                    $this->load->view('layout',$data);
                }
                elseif($user->role_id == 1)
                {
                    redirect(site_url('Freelancer'));
                }
            }
            else
            {
                redirect(site_url('Login'));
            }

        }
    }