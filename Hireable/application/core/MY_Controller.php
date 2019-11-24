<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    // protected $data;

    function __construct()
    {
        parent::__construct();
    } 
    public function search($role_id = false){

        // loading database tables for search functionalities
        $this->load->model('Projects');
        $this->load->model('PCategories');
        $this->load->model('FCategories');

        // ---  Search Freelancer Through Categories  --- //
        if (isset($_REQUEST['skill'])) 
        {
            $category  = $_REQUEST['skill'];
            if (!empty(trim($category))) {
                $like = [
                    'category' =>  $category
                ];
                $search_results = $this->FCategories->joins('categories', 'category_id', $like)->result();
                if (!count($search_results)) {
                    $freelancers = [];
                } else {
                    foreach ($search_results as $search_result) {
                        $users[] = $search_result->user_id;
                    }
                    foreach ($users as $user) {
                        $where = [
                            'user_id' => $user
                        ];
                        $freelancers[]   = $this->Users->getData($where)->row();
                    }
                }
            } else {
                $whereRoleId = [
                    'role_id' => 1
                ];
                $freelancers   = $this->Users->getData($whereRoleId)->result();
            }
            
            $this->session->set_flashdata('search', $category);
            return $freelancers;
        }       
        // ---  Search Freelancer Through Categories  --- //
        elseif(isset($_REQUEST['required-skill']))
        {
            $category = $_REQUEST['required-skill'];
            if(!empty(trim($category)))
            {
                $like = [
                    'category' =>  $category
                ];
                $search_results = $this->PCategories->joins('categories', 'category_id', $like)->result();
                if(!count($search_results))
                {
                    $Projects = [];
                }
                else
                {
                    foreach($search_results as $search_result)
                    {
                        $project_ids[] = $search_result->project_id;
                    }
                    $project_ids = array_unique($project_ids);
                    foreach($project_ids as $project_id)
                    {
                        $where = [
                            'project_id' => $project_id
                        ];
                        $projects[]   = $this->Projects->getData($where)->row(); 
                    }   
                }                
            }
            else
            {
                $projects[]   = $this->projects->getData()->result();
            }

            $this->session->set_flashdata('search', $category);
            return $projects; 
        }
        else
        {
            if($role_id == 1)
            {
                $projects   = $this->Projects->getData()->result();
                return $projects;
            }
            else
            {
                $whereRoleId = [
                    'role_id' => 1
                ];
                $freelancers   = $this->Users->getData($whereRoleId)->result();
            }
        }
    }

}
