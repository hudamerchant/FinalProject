<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddClientReview extends MY_Controller{
        public function index(){
            function __construct(){
                parent::__construct();
            }
                $this->load->model('Users');
                if($this->session->userdata('logged_in')){
                    $where  = [ 'email' => $this->session->userdata('user_info') ];
                    $user   = $this->Users->getData($where)->row();
                    if($user->role_id == 2)
                    {
                        $data['view'] = 'AddClientReview';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'AddClientReview -'.$data['site_title']; 
    
                        //Client info
                        $data['client_info'] = $user;
                        $this->load->view('layout',$data);
                    }
                    elseif($user->role_id == 1)
                    {
                        redirect(site_url('Freelancer'));
                    }
                }
                else
                {
                    redirect(site_url('Login'));
                }

    
        }
    }

?>