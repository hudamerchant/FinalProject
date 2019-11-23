
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class freelancerBids extends MY_Controller{
        public function index(){
            $data['view'] = 'freelancerBids';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Bids -'.$data['site_title'];
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
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
                        $this->load->model('ProjectBid');
                        $whereUserId = [
                            'user_id' => $user->user_id
                        ];
                        $userBids = $this->ProjectBid->getData($whereUserId)->result();
                        
                        if($userBids){
                            $this->session->set_flashdata("freelancerBidsPresent",true);
                                $whereUserId = [
                                    'project_bids.user_id' => $user->user_id
                                ];
                                
                                $this->load->model('Projects');
                                
                                $fetchingProjects []= ['table_name'=>'project_bids', 'column_with'=>'project_bids.project_id = projects.project_id']; 
                                $fetchingProjects []= ['table_name'=>'users', 'column_with'=>'projects.user_id = users.user_id']; 
                                
                                $selectArray = ['project_bids'.'.user_id', 
                                'project_bids'.'.project_id',                           
                                'projects'.'.project_title',                            
                                'users'.'.name',
                                'users'.'.email'
                                ];
    
                                $results = $this->Projects->multiple_joins($fetchingProjects,$whereUserId,$selectArray)->result();
                                
                                $data['results'] = $results; 
                        }
                        return $this->load->view('layout',$data);
                    }
                } 
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client'));
                }
                $this->load->view('layout',$data);
            }
            else
            {
                redirect(site_url('Login'));
            } 
        }
    }

?>