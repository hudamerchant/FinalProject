
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddProject extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1)
                {       
                    redirect(site_url('Freelancer'));
                    
                }
                elseif($user->role_id == 2)
                {
                    $data['view'] = 'AddProject';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Add project - '.$data['site_title']; 
                    //$this->load->view('layout',$data);                   
                    //loading database table categories
                    $this->load->model('Categories');
                    $categories         = $this->Categories->getData()->result();
                    $data['categories'] = $categories;
                    

                    if(isset($_POST['submit'])){
                        $this->form_validation->set_rules('project-title', 'project title', 'required');
                        $this->form_validation->set_rules('project-description', 'project description', 'required');
                        $this->form_validation->set_rules('categories[]', 'skills', 'required');
                        // $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
                        if($this->form_validation->run() == True) {
                            $project_title = $this->input->post('project-title');
                            $project_description = $this->input->post('project-description');
                            
                        }
                        else{
                            $this->load->view('layout',$data);

                        }
                    }
                    else{
                        $this->load->view('layout',$data);
                    }
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
            
        
    }

?>