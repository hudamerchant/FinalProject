<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About_us extends MY_Controller{
        public function index(){
            $data['view'] = 'About_us';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'About Us -'.$data['site_title']; 
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->updated_profile == 0)
                {
                    return redirect(site_url('updateFProfile'));
                }
                else
                {
                    $this->load->view('layout',$data);
                }
    
            }
            else
            {
                $this->load->view('layout',$data);
            }
        }
    }
?>