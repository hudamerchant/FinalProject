<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ProjectDetails extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($project_apply_id = false){    
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $data['view'] = 'ProjectDetails';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'Project Details - '.$data['site_title']; 

                        $data['applied'] = [];
                        $this->load->model('ProjectBid');
                        $where      = ['user_id' => $user->user_id];
                        $applied    = $this->ProjectBid->getData($where)->result();
                        foreach($applied as $v){
                            $data['applied'][] = $v->project_id;
                        }

                        if($project_apply_id){
                            $this->load->model('Projects');
                            $whereProjectId = [
                                'project_id'    => $project_apply_id
                            ];
                            
                            $projects = $this->Projects->getData($whereProjectId)->result();
                            if($projects){
                                $count = 0;
                                foreach ($projects as $project) {
                                    $data['projects'][$count]['title'] = $project->project_title;
                                    $data['projects'][$count]['description'] = $project->project_descript;
                                    $data['projects'][$count]['project_id'] = $project->project_id;
                                    $data['projects'][$count]['user_id'] = $project->user_id;

                                    $whereUserId = [
                                        'user_id' => $project->user_id
                                    ];
                                    $userIdData = $this->Users->getData($whereUserId)->row();
                                    $data['projects'][$count]['name'] = $userIdData->name;
                                    $data['projects'][$count]['email'] = $userIdData->email;

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
                            
                            //var_dump($projects);die;
                        }

                        return $this->load->view('layout',$data);
                    }
                }
                elseif($user->role_id == 2)
                {
                    return redirect(site_url('Client'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }

?>