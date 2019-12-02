<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About_us extends MY_Controller{
        public function index(){
            $this->data['view'] = 'about_us';
            $this->data['site_title'] = 'Hireable';
            $this->data['page_title'] = 'About Us -'.$this->data['site_title']; 
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if(!$user->updated_profile)
                {
                    return redirect(site_url('Update_freelancer_profile'));
                }
    
            }
            $this->load->view('layout',$this->data);
        }
    }
?>