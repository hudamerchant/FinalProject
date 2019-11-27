<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Chatbox extends MY_Controller{

        function __construct()
        {
            parent::__construct();
            $this->client_id = $this->session->userdata('client_id');
            $this->load->model('Userchat');
            
        }
        function index($freelancerID = true){
            
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if ($user->role_id == 1) 
                {
                    return redirect(site_url('Freelancer'));
                } 
                elseif ($user->role_id == 2) 
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateCProfile'));
                    }
                    else
                    {
                        $data['view'] = 'Chatbox';
                        $data['site_title'] = 'Chat Assignment';
                        $data['page_title'] = 'Chat - '.$data['site_title'];

                        if ($freelancerID) {
                            // echo "Hogaya";die;
                        }
                    }


                }
            }

            $this->load->view('layout', $data);
        }

        function insert_messages(){
                $msg = [
                    'client_id'     => 5,
                    'frrlancer_id'     => 6,
                    'chats_msg' => $_REQUEST['msg']
                ];

                $this->Userchat->inserting($msg);

            $data['view'] = 'Chatbox';
            $this->load->view('layout', $data);
        }

        function get_messages( ){
          
            $offset = $_REQUEST['offset'];
            $data   = $this->Userchat->offset_retrieving($offset,5); 
            $html   = '';

            foreach($data as $chat_obj){
                $html .= "<li class='for_del'>".$chat_obj->chats_msg."</li>";
            }
            echo $html;
        }
    }