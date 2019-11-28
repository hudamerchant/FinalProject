<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Chatbox extends MY_Controller{

        function __construct()
        {
            parent::__construct();
            $this->client_id = $this->session->userdata('client_id');
            $this->load->model('Userchat');
            
        }
        function index(){
            
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

                        
                        // $chats = $this->Chats->getData()->result();
                        // var_dump($chats);die;
                        // if ($freelancerID) {
                        //     // echo "Hogaya";die;
                        // }
                    }


                }
            }

            $this->load->view('layout', $data);
        }

        function insert_messages($freelancerID = true){
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if ($freelancerID) {
                    if(isset($_REQUEST['msg'])){

                    
                        $msg = [
                            'sender_id'     => $user->user_id,
                            'receiver_id'     => $freelancerID,
                            'message' => $_REQUEST['msg']
                        ];
                        $this->load->model('Chats');
                        $this->Chats->insertRecord($msg);

                    $data['view'] = 'Chatbox';
                    $this->load->view('layout', $data);
                    }
                }
            }
        }

        function get_messages( $ReceiverId = true){

            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                if ($ReceiverId) {
                    $this->load->model('Chats');
                    $senderID = $user->user_id;
                    $offset = $_REQUEST['offset'];

                    $data   = $this->Chats->offset_retrieving($offset,1,$senderID,$ReceiverId); 
                    // var_dump($this->db->last_query());die;
                    $html   = '';

                    foreach($data as $chat_obj){
                        // var_dump($chat_obj);die;
                        $html .= "<li class='chatbox-li'>".$chat_obj->message."</li>";
                    }
                    echo $html;
                }
            }
          
            
        }
    }