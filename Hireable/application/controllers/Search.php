<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Search extends MY_Controller{
        public function index($project_apply_id = false){
            
            $this->data['view'] = 'Search';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Search - '.$this->data['site_title'];
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                
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
                        // var_dump($projects);die;
                        $this->data['applied'] = [];
                        $this->load->model('ProjectBid');
                        $where      = ['user_id' => $user->user_id];
                        $applied    = $this->ProjectBid->getData('DESC',$where)->result();
                        foreach($applied as $v){
                            $this->data['applied'][] = $v->project_id;
                        }

                        // $this->load->model('Projects');
                        // $projects = $this->Projects->getData()->result();
                        if(!count($projects))
                        {
                            $msg = 'Sorry! No Result Found.';
                            $this->data['msg'] = $msg;
                        } 
                        else
                        {
                            $count = 0;
                            // var_dump($projects);die; 
                            
                            foreach ($projects as $project) {
                                    
                                $category_id = [];
                                $this->data['projects'][$count]['title'] = $project->project_title;
                                $this->data['projects'][$count]['description'] = $project->project_descript;
                                $this->data['projects'][$count]['project_id'] = $project->project_id;
                                $this->data['projects'][$count]['user_id'] = $project->user_id;
                                $whereUserId = [
                                    'user_id' => $project->user_id
                                ];
                                $userIdData = $this->Users->getData('DESC',$whereUserId)->row();
                
                                $this->data['projects'][$count]['name'] = $userIdData->name;
                                $this->data['projects'][$count]['email'] = $userIdData->email;
                                if($userIdData->profile_pic){

                                    $this->data['projects'][$count]['profile_pic_path'] = $this->data['image_path'];
                                    $this->data['projects'][$count]['profile_pic'] = $userIdData->profile_pic;
                                }
                                // var_dump($this->data['projects']);die;

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
                            if($project_apply_id){
                                // var_dump($project_apply_id);die;
                                $freelanerBidWhere = [
                                    'user_id'       => $user->user_id,
                                    'project_id'    => $project_apply_id
                                ];
                                $this->load->model('ProjectBid');
                                
                                
                                $result = $this->ProjectBid->getData('DESC',$freelanerBidWhere )->row();
                                if($result == null)
                                {
                                    $this->ProjectBid->insertRecord($freelanerBidWhere);
                                    
                                    $reciever       = $userIdData->email;
                                    $sender         = $user->email;
                                    $subject        = 'Freelancer Bid For Your Project ';
                                    
                                    $this->data['view'] = 'applyemail';
                                    $this->data['name']   = $userIdData->name;

                                    $mailContent = $this->load->view('email/email_layout',$this->data, true);
                                    
                                    $this->sendMail($subject, $mailContent, $reciever , $sender);
                                }
                                $this->session->set_flashdata("Bid",'Bid success');
                                return redirect(site_url('Search'));
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
                            
                        // if($freelancers == null){

                        // }
                        if(!count($freelancers))
                        {
                            $msg = 'Sorry! No Result Found.';
                            $this->data['msg'] = $msg;
                        }
                        else
                        {
                            $this->data['freelancers'] = $freelancers;
                            // $this->data['freelancers'] .= $this->data['image_path'];
                            // var_dump($this->data['freelancers']);die;
                            $avg_rating = [];
                            foreach($freelancers as $freelancer){
                                $whereFreelancerId = [
                                    'receiver_id' => $freelancer->user_id
                                ];
                                $select = 'avg(rating)';
                                $this->load->model('Reviews_Model');
                                $Ratings = $this->Reviews_Model->retrieve_ratings('DESC',$select,$whereFreelancerId);
                                $avg_rating[$freelancer->user_id] = $Ratings;
                                // var_dump($avg_rating);
                            }
                            $this->data['ratings'] = $avg_rating;
                        }
                    }
                }    
                return $this->load->view('layout',$this->data);
            }
            else
            {  
                $freelancers = $this->search();
                if(!$freelancers)
                {
                    $msg = 'Sorry! No Result Found.';
                    $this->data['msg'] = $msg;
                }
                else
                {
                    $this->data['freelancers'] = $freelancers;
                }
                return $this->load->view('layout',$this->data);
            }
        }

    }

?>