<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
        if($this->session->userdata('logged_in')){
            $this->load->model('Users');
            $where  = [ 'email' => $this->session->userdata('user_info') ];
            $user   = $this->Users->getData($where)->row();
            if($user->role_id == 1)
            {
                redirect(site_url('Freelancer'));
            }
            elseif($user->role_id == 2)
            {
                redirect(site_url('Client'));
            }
        }
        else
        {
            $data['view'] = 'Login';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Login - '.$data['site_title'];
    
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
                            if($query->role_id == 1)
                            {
                                redirect(site_url('Freelancer'));
                            }
                            elseif($query->role_id == 2)
                            {
                                redirect(site_url('Client'));
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
}
