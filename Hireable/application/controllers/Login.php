<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $data['view'] = 'Login';
        $data['page_title'] = 'Login';

        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');

            if($this->form_validation->run() == True) {
                $this->load->view('layout',$data);
                $this->load->model('Users');
                $data = [
                    'email' => $_POST['email']
                ];
                $query = $this->Users->whereData($data);
                if($query){
                    $password = $_POST['password'];
                    
                    if(password_verify($password,$query->password)){
                        $this->load->view('layout',$data);
                        $this->session->set_userdata('logged_in' , True );
                        $this->session->set_userdata('user_info' , $query->email );
                        if($query->role_id == 1){
                            redirect('Home');
                        }
                        if($query->role_id == 2){
                            redirect('About_us');
                        }
                        

                    }
                    else{
                        $this->session->set_flashdata("error","Passwords dont match");
                        redirect('Login');
                    }
                }
                else{
                    $this->session->set_flashdata("error","No such email exists");
                    redirect('Login');
                    
                }

            }
            else{
                $this->load->view('layout',$data);
            }
        }

        $this->load->view('layout',$data);
    }
}
