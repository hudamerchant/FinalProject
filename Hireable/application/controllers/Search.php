<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Search extends MY_Controller{
        public function index($project_apply_id = false){
            $data['view'] = 'Search';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Search - '.$data['site_title'];
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                
                if ($user->role_id == 1) {
                    $role_id = $user->role_id;
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $projects = $this->search($role_id);
                        //applied projects
                        $data['applied'] = [];
                        $this->load->model('ProjectBid');
                        $where      = ['user_id' => $user->user_id];
                        $applied    = $this->ProjectBid->getData($where)->result();
                        foreach($applied as $v){
                            $data['applied'][] = $v->project_id;
                        }

                        // $this->load->model('Projects');
                        // $projects = $this->Projects->getData()->result();
                        if(!count($projects))
                        {
                            $msg = 'Sorry! No Result Found.';
                            $data['msg'] = $msg;
                        } 
                        else
                        {
                            $count = 0;
                            // var_dump($projects);die; 
                            $this->session->set_flashdata("projectsPresent",true);
                            foreach ($projects as $project) {
                                    
                                $category_id = [];
                                $data['projects'][$count]['title'] = $project->project_title;
                                $data['projects'][$count]['description'] = $project->project_descript;
                                $data['projects'][$count]['project_id'] = $project->project_id;
                                //$data['projects'][$count]['user_id'] = $project->user_id;
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
                            if($project_apply_id){
                                $freelanerBidWhere = [
                                    'user_id'       => $user->user_id,
                                    'project_id'    => $project_apply_id
                                ];
                                $this->load->model('ProjectBid');
                                $result = $this->ProjectBid->getData($freelanerBidWhere)->row();
                                if($result == null)
                                {
                                    $this->ProjectBid->insertRecord($freelanerBidWhere);
                                }
                                $this->session->set_flashdata("Bid",'Bid success');
                                return redirect(site_url('Freelancer'));
                            }   
                        }
                    }
                }
                elseif($user->role_id == 2){
                    $role_id = $user->role_id;
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        $freelancers = $this->search($role_id);
                        if(!count($freelancers))
                        {
                            $msg = 'Sorry! No Result Found.';
                            $data['msg'] = $msg;
                        }
                        else
                        {
                            $data['freelancers'] = $freelancers;
                        }
                    }
                }    
                return $this->load->view('layout',$data);
            }
            else
            {  
                $freelancers = $this->search();
                $data['freelancers'] = $freelancers;
                return $this->load->view('layout',$data);
            }
        }
    }

?>