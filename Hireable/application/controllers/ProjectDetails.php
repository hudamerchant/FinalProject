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
                $user   = $this->Users->getData('DESC' ,$where)->row();
                if($user->role_id == 1)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $this->data['view'] = 'ProjectDetails';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Project Details - '.$this->data['site_title']; 

                        $this->data['applied'] = [];
                        $this->load->model('ProjectBid');
                        $where      = ['user_id' => $user->user_id];
                        $applied    = $this->ProjectBid->getData('DESC' ,$where)->result();
                        foreach($applied as $v){
                            $this->data['applied'][] = $v->project_id;
                        }

                        if($project_apply_id){
                            $this->load->model('Projects');
                            $whereProjectId = [
                                'project_id'    => $project_apply_id
                            ];
                            
                            $projects = $this->Projects->getData('DESC' ,$whereProjectId)->result();
                            // var_dump($projects);die;
                            if($projects){
                                $count = 0;
                                foreach ($projects as $project) {
                                    $this->data['projects'][$count]['title'] = $project->project_title;
                                    $this->data['projects'][$count]['description'] = $project->project_descript;
                                    $this->data['projects'][$count]['project_id'] = $project->project_id;
                                    $this->data['projects'][$count]['user_id'] = $project->user_id;

                                    $whereUserId = [
                                        'user_id' => $project->user_id
                                    ];
                                    $userIdData = $this->Users->getData('DESC' ,$whereUserId)->row();
                                    $this->data['projects'][$count]['name'] = $userIdData->name;
                                    $this->data['projects'][$count]['email'] = $userIdData->email;
                                    if($userIdData->profile_pic != ''){
                                        $this->data['projects'][$count]['profile_pic'] = $this->data['image_path'].$userIdData->profile_pic;
                                    }
                                    // var_dump($this->data['projects'][$count]['profile_pic']);die;

                                    $this->load->model('ProjectCategories');
                                    $projectCategoryWhere = [
                                        'project_id' => $project->project_id
                                    ];
                                    $categoryVariable = $this->ProjectCategories->getData('DESC' ,$projectCategoryWhere)->result();
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
                            
                            //var_dump($projects);die;
                        }

                        return $this->load->view('layout',$this->data);
                    }
                }
                elseif($user->role_id == 2)
                {
                    return redirect(site_url('Client_dashboard'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }

?>