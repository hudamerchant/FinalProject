<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Client extends MY_Controller{
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
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        $this->data['view']       = 'CDashboard';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Dashboard -'.$this->data['site_title'];      
                        
                        $this->load->model('Projects');

                        $where = [
                            'user_id'   => $user->user_id,
                            'deleted_at'    => null
                        ];
                        $projects = $this->Projects->getData('DESC',$where)->result();

                        // var_dump($projects);die;

                        // $this->load->model('ProjectBid');

                        // $where = [
                        //     'projects.user_id'   => $user->user_id,
                        //     'projects.deleted_at'    => null
                        // ];
                        // $like = [];
                        // $projects = $this->ProjectBid->joins('projects','project_id',$like,'DESC','projects.updated_at',$where)->result();
                        // var_dump($projects);die;
                        // var_dump($this->db->last_query());die;
                        
                        $this->load->model('ProjectBid');
                        
                        $count = 0;
                        if($projects){
                            
                            $this->session->set_flashdata("projectsPresent",true);
                            // var_dump($projects);die;
                            foreach ($projects as $project) {
                                $where      = ['user_id' => $project->hired_freelancer_id ];
                                $freelancer = $this->Users->getData('DESC',$where)->row();
                                // var_dump($freelancer);die;

                                $category_id = [];
                                $this->data['projects'][$count]['title'] = $project->project_title;
                                $this->data['projects'][$count]['description']      = $project->project_descript;
                                $this->data['projects'][$count]['project_id']       = $project->project_id;
                                $this->data['projects'][$count]['bid_status']       = $project->project_status;

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