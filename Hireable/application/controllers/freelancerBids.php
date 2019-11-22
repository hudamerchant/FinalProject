
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
                if($user->updated_profile == 0)
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
                    //var_dump($userBids);die;
                    if($userBids){
                        $this->session->set_flashdata("freelancerBidsPresent",true);
                        $this->load->model('Projects');
                        $count=0;
                        foreach ($userBids as $userBid) {

                            $whereUserId = [
                                'project_bids.user_id' => $user->user_id
                            ];
                            $selectArray = [$this->ProjectBid->table_name.'.user_id',
                            $this->ProjectBid->table_name.'.project_id',
                            $this->Projects->table_name.'.project_title',
                            $this->Projects->table_name.'.project_descript'
                            ];
                            
                            $fetchingProjects = $this->ProjectBid->joins('project_bids','projects','project_id',$whereUserId,$selectArray)->result();
                            // var_dump($this->db->last_query());die;
                            if($fetchingProjects){
                                
                                //var_dump($fetchingProjects);die;
                                $i = 0;
                                
                                foreach ($fetchingProjects as $fetchingProject) {
                                    //var_dump($fetchingProjects);
                                    
                                    $data['freelancerBids'][$i]['project_title'] = $fetchingProject->project_title;
                                    
                                    $i++;
                                }
                            }
                            
                            $data['freelancerBids'][$count]['project_id'] = $userBid->project_id;
                            $count++;
                            
                        }
                        //var_dump($data['freelancerBids']);
                    }
                    $this->load->view('layout',$data);
                }
    
            }
        }
    }

?>