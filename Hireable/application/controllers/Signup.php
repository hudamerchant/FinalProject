<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $data['view'] = 'Signup';
        $data['page_title'] = 'Signup';

        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('dob', 'dob', 'required');
            $this->form_validation->set_rules('gender', 'gender', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('role', 'role', 'required');

            if($this->form_validation->run() == True) {
            
                $name           = $this->input->post('name');
                $dob            = $this->input->post('dob');
                $role           = $this->input->post('role');
                $gender         = $this->input->post('gender');
                $email          = $this->input->post('email');
                $password       = $this->input->post('password');
                $re_password    = $this->input->post('re_password');

                if($password == $re_password)
                {
                    $hash = password_hash($password,PASSWORD_DEFAULT);
                

                    $this->load->model('Users');
                    $data = [
                        'name' => $name,
                        'dob' => $dob,
                        'gender' => $gender,
                        'email' => $email,
                        'password' => $hash,
                        'role_id' => $role
                    ];
                    
                    $this->Users->insertRecord($data);
                    $this->session->set_flashdata("status","Your account has been created successfully!");
                    $this->session->set_userdata('logged_in' , True );

                    redirect(site_url('Login'));
                }
                else
                {                    
                    $data['error']      = 'Incorrect Password';
                    $this->load->view('layout',$data);
                    
                }

                

            }
            else{
                $this->load->view('layout',$data);
            }
        }

        $this->load->view('layout',$data);
    }
     
}
