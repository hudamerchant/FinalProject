<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    // protected $data;

    function __construct()
    {
        parent::__construct();
    } 
    public function search(){
        if(isset($_REQUEST['skill']))
        {
            $skill = $_REQUEST['skill'];
            if(!empty(trim($skill)))
            {
                $this->load->model('FCategories');
                $where = [
                    'category' =>  $_REQUEST['skill']
                ];
                $search_results = $this->FCategories->joins('categories', 'category_id', $where)->result();

                foreach($search_results as $search_result)
                {
                    $users[] = $search_result->user_id;
                }
                foreach($users as $user)
                {
                    $where = [
                        'user_id' => $user
                    ];
                    $freelancers[]   = $this->Users->getData($where)->row();
                }
                
            }
            else
            {
                $whereRoleId = [
                    'role_id' => 1
                ];
                $freelancers   = $this->Users->getData($whereRoleId)->result();
    
            }

            $this->session->set_flashdata('search', $skill);
            return $freelancers; 
        }
    }
    
}

?>