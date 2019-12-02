<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends MY_Controller{
        public function index(){
            $this->data['view'] = 'Home';
            $this->data['page_title'] = 'Home';
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if(!$user->updated_profile)
                {
                    return redirect(site_url('Update_freelancer_profile'));
                }
                else
                {
                    return $this->load->view('layout',$this->data);
                }
    
            }
            else
            {
                $this->load->view('layout',$this->data);
            }
        }
    }

?>