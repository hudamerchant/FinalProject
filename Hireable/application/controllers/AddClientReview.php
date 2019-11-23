<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddClientReview extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 2)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        $data['view'] = 'AddClientReview';
                        $data['site_title'] = 'Hireable';
                        $data['page_title'] = 'AddClientReview -'.$data['site_title']; 
    
                        //Client info
                        $data['client_info'] = $user;
                        return $this->load->view('layout',$data);
                    }
                    
                }
                elseif($user->role_id == 1)
                {
                    return redirect(site_url('Freelancer'));
                }
            }
            else
            {
                return redirect(site_url('Login'));
            }
        }
    }

?>