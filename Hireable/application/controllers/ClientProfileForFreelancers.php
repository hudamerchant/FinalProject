<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ClientProfileForFreelancers extends MY_Controller{
        public function index($client_user_id = false){
            function __construct(){
                parent::__construct();
            }
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData($where)->row();
                if($user->role_id == 1){

                    $data['view'] = 'ClientProfileForFreelancers';
                    $data['site_title'] = 'Hireable';
                    $data['page_title'] = 'Client Profile - '.$data['site_title']; 

                    if($client_user_id){
                        $count = 0;
                        $whereUserId = [
                            'user_id' => $client_user_id
                        ];
                        $clientData = $this->Users->getData($whereUserId)->row();
                        $data['clientDetails'][$count]['name'] = $clientData->name;
                        $data['clientDetails'][$count]['dob'] = $clientData->dob;
                        $data['clientDetails'][$count]['gender'] = $clientData->gender;
                        $data['clientDetails'][$count]['email'] = $clientData->email;

                        $clientDetails = $data['clientDetails'];

                        foreach($clientDetails as $clientDetail){
                            
                            $data['clientDetail'] = $clientDetail;
                        }

                    }
                    
                    $this->load->view('layout',$data);
                    
                }
                elseif($user->role_id == 2)
                {
                    redirect(site_url('Client'));
                }
            }
            else
            {
                redirect(site_url('Login'));
            }
        }
    }