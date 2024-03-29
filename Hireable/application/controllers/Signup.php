<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller
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
                if($user->updated_profile == 0)
                {
                    return redirect(site_url('Update_freelancer_profile'));
                }
                else
                {
                    redirect(site_url('Freelancer'));
                }
            }
            elseif($user->role_id == 2)
            {
                redirect(site_url('Client_dashboard'));
            }
        }
        else
        {
            $this->data['view'] = 'signup';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'Signup - '.$this->data['site_title'];

            if(isset($_POST['submit'])){
                $this->load->helper('Other');
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('dob', 'dob', 'required');
                $this->form_validation->set_rules('gender', 'gender', 'required');
                $this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]|valid_email');
                $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
                $this->form_validation->set_rules('role', 'role', 'required');

                if($this->form_validation->run() == True) {
                
                    $name           = $this->input->post('name');
                    $dob            = dbDate($this->input->post('dob'));
                    $role           = $this->input->post('role');
                    $gender         = $this->input->post('gender');
                    $email          = $this->input->post('email');
                    $password       = $this->input->post('password');
                    $re_password    = $this->input->post('re_password');

                    if($password == $re_password)
                    {
                        $hash = password_hash($password,PASSWORD_DEFAULT);
                    

                        $this->load->model('Users');
                        $this->data = [
                            'name' => $name,
                            'dob' => $dob,
                            'gender' => $gender,
                            'email' => $email,
                            'password' => $hash,
                            'role_id' => $role
                        ];
                        
                        $this->Users->insertRecord($this->data);
                        $this->session->set_flashdata("status","Your account has been created successfully! You can login now.");

                        $reciever       = $email;
                        $subject        = 'Confirm Registeration ';
                        
                        $this->data['view'] = 'register_email';
                        $this->data['name']   = $name;

                        $mailContent = $this->load->view('email/email_layout',$this->data, true);
                        
                        $this->sendMail($subject, $mailContent, $reciever );

                        redirect(site_url('Login'));
                    }
                    else
                    {                    
                        $this->data['error']      = 'Passwords dont match';
                        $this->load->view('layout',$this->data);
                        
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
