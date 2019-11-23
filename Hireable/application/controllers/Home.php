<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends MY_Controller{
        public function index(){
            $data['view'] = 'Home';
            $data['page_title'] = 'Home';
            if($this->session->userdata('logged_in')){
                $this->load->model('Users');
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if(!$user->updated_profile)
                {
                    return redirect(site_url('updateFProfile'));
                }
                else
                {
                    return $this->load->view('layout',$data);
                }
    
            }
            else
            {
                $this->load->view('layout',$data);
            }
        }
    }

?>