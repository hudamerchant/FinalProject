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
            $user   = $this->Users->getData('DESC' ,$where)->row();
            if($user->role_id == 1)
            {
                if($user->updated_profile)
                {
                    redirect(site_url('Freelancer'));
                }
                else
                {
                    return redirect(site_url('Update_freelancer_profile'));
                }

            }
            elseif($user->role_id == 2)
            {
                if($user->updated_profile)
                {
                    redirect(site_url('Client_dashboard'));
                }
                else
                {
                    return redirect(site_url('Update_client_profile'));
                }
            }
        }
        else
        {
            $this->data['view'] = 'login';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Login - '.$this->data['site_title'];
    
            if(isset($_POST['submit'])){
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('password', 'password', 'required');
    
                if($this->form_validation->run() == True) {
                    $this->load->model('Users');
                    $this->data = [
                        'email' => $_POST['email']
                    ];
                    $query = $this->Users->whereData($this->data);
                    if($query){
                        $password = $_POST['password'];
                        
                        if(password_verify($password,$query->password)){
                            $this->session->set_userdata('logged_in' , True );
                            $this->session->set_userdata('user_info' , $query->email );
                            if($query->role_id == 1)
                            {
                                $this->session->set_userdata('freelancerRole','1');
                                if($query->updated_profile)
                                {
                                    return redirect(site_url('Freelancer'));
                                }
                                else
                                {
                                    return redirect(site_url('Update_freelancer_profile'));
                                }
                            }
                            elseif($query->role_id == 2)
                            {
                                $this->session->set_userdata('ClientRole','2');
                                if($query->updated_profile)
                                {
                                    return redirect(site_url('Client_dashboard'));
                                }
                                else
                                {
                                    return redirect(site_url('Update_client_profile'));
                                }
                            }
                            
    
                        }
                        else{
                            $this->session->set_flashdata("error","Incorrect Password");
                            redirect('Login');
                        }
                    }
                    else{
                        $this->session->set_flashdata("error","No such email exists");
                        redirect('Login');
                        
                    }
    
                }
                else{
                    $this->load->view('layout',$this->data);
                }
            }
            $this->load->view('layout',$this->data);
        }
        
    }
}
