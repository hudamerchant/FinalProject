<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class updateCProfile extends MY_Controller{
        function __construct(){
            parent::__construct();
            }
        public function index(){
            $data['view'] = 'updateCProfile';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Update - '.$data['site_title'];
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                //var_dump($user);
                if($user->role_id == 1)
                {
                    return redirect(site_url('updateFProfile'));
                }
                if(isset($_POST['submit']))
                    {
                        $this->form_validation->set_rules('name', 'name', 'required');
                        $this->form_validation->set_rules('dob', 'dob', 'required');
                        $this->form_validation->set_rules('gender', 'gender', 'required');
                        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                        if($this->form_validation->run() == True) {

                            $name          = $this->input->post('name');
                            $dob         = $this->input->post('dob');
                            $gender        = $this->input->post('gender');
                            $email = $this->input->post('email');

                            $this->load->model('Users');

                            // $update_data    =   [   'name'  => $name,
                            //                         'email' => $email,
                            //                     ];
                            // $profile_data   =   [ 'p_description' => $p_description ];
                            // $skills         =   ['skill' => $skills ];
                            // $query = $this->Users->updateData($data);
                            // if($query){
                            //     var_dump('hello');die;
                                
                            // }
                        }
                        else{
                            $data['client_info'] = $user;
                            $this->load->view('layout',$data);
                        }
                    }
                    else{
                        $data['client_info'] = $user;
                        $this->load->view('layout',$data);
                    }
            }
            
        }
    }

?>