<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateFProfile extends MY_Controller{
        function __construct(){
        parent::__construct();
        }
        public function index(){

            // if($this->session->userdata('profile_updated'))
            // {
            //     redirect(site_url('Freelancer'));
            // }
            // else
            // {         
                $data['view']       = 'updateFProfile';
                $data['site_title'] = 'Hireable';
                $data['page_title'] = 'Update -'.$data['site_title'];
                $this->load->model('Users');
                if($this->session->userdata('logged_in')){
                    $where  = [ 'email' => $this->session->userdata('user_info') ];
                    $user   = $this->Users->getData($where)->row();
                    if($user->role_id == 2)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        if(isset($_POST['submit']))
                        {
                            $this->session->set_userdata('profile_updated', True );
                            $this->form_validation->set_rules('name', 'name', 'required');
                            $this->form_validation->set_rules('skills', 'skills', 'required');
                            $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
                            $this->form_validation->set_rules('p_description', 'project description', 'required');
                            if($this->form_validation->run() == True) {

                                $name          = $this->input->post('name');
                                $email         = $this->input->post('email');
                                $skills        = $this->input->post('skills');
                                $categories    = $this->input->post('categories');
                                $p_description = $this->input->post('p_description');

                                $this->load->model('Users');

                                // $update_data    =   [   'name'  => $name,
                                //                         'email' => $email,
                                //                     ];
                                                    
                                // $profile_data   =   [   'profile_description' => $p_description, 
                                //                         'user_id'             => $user->user_id ];
                                // $skills         =   ['skill' => $skills ];
                               
                                // // $query = $this->Users->updateData($data);
                                // // if($query){
                                // //     var_dump('hello');die;
                                    
                                // // }

                                
                            }
                            else
                            {
                                $data['freelancer_info'] = $user;
                                $this->load->view('layout',$data);
                            }
                        }  
                        else
                        {
                            $data['freelancer_info'] = $user;
                            $this->load->view('layout',$data);
                        }
                    }
                    
                }
                else
                {                
                    redirect(site_url('Login'));
                }

            // }
        }
    }