<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateFProfile extends MY_Controller{
        function __construct(){
        parent::__construct();
        }
        public function index(){
                $data['view']       = 'updateFProfile';
                $data['site_title'] = 'Hireable';
                $data['page_title'] = 'Update -'.$data['site_title'];

                //loading models
                $this->load->model('Users');
                $this->load->model('Categories');

                $categories         = $this->Categories->getData()->result();
                $data['categories'] = $categories;


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
                            $this->form_validation->set_rules('categories', 'categories', 'required');
                            $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
                            $this->form_validation->set_rules('p_description', 'project description', 'required');
                            if($this->form_validation->run() == True) {

                                $name          = $this->input->post('name');
                                $email         = $this->input->post('email');
                                $categories    = $this->input->post('categories');
                                $p_description = $this->input->post('p_description');

                                $update_data    =   [   'name'              => $name,
                                                        'email'             => $email,
                                                        'updated_profile'   => 1
                                                    ];
                                                    
                                $profile_data   =   [   'profile_description' => $p_description, 
                                                        'user_id'             => $user->user_id 
                                                    ];
                                
                                //$categories     =   []; 
                                var_dump($categories);die;

                                // foreach($categories as $index => $category){
                                //     $categories[$index] 
                                //     = ['category_id' => ,
                                //         'user_id'    => ];
                                // }
                                
                               
                                // $query = $this->Users->updateData($data);
                                // if($query){
                                //     var_dump('hello');die;
                                    
                                // }

                                
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