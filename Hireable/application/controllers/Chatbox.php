<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Chatbox extends MY_Controller{

        function __construct()
        {
            parent::__construct();
            $this->client_id = $this->session->userdata('client_id');
            $this->load->model('Userchat');
            
        }
        function index($ReceiverId = false){
            
            // $this->load->model('Users');
            // if ($this->session->userdata('logged_in')) {
            //     $where  = [ 'email' => $this->session->userdata('user_info') ];
            //     $user   = $this->Users->getData('DESC',$where)->row();
            //     if ($user->role_id == 1) 
            //     {
            //         return redirect(site_url('Freelancer'));
            //     } 
            //     elseif ($user->role_id == 2) 
            //     {
            //         if(!$user->updated_profile)
            //         {
            //             return redirect(site_url('updateCProfile'));
            //         }
            //         else
            //         {
                        $this->data['view'] = 'Chatbox';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Chat - '.$this->data['site_title'];
                        $this->data['receiver_id'] = $ReceiverId;



            //         }


            //     }
            // }

            $this->load->view('layout', $this->data);
        }

        function insert_messages(){
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                    if(isset($_REQUEST['msg'])){

                        $receiver_id = $_REQUEST['receiver_id'];
                    
                        $msg = [
                            'sender_id'     => $user->user_id,
                            'receiver_id'   => $receiver_id,
                            'message'       => $_REQUEST['msg']
                        ];
                        $this->load->model('Chats');
                        $this->Chats->insertRecord($msg);

                    $data['view'] = 'Chatbox';
                    $this->load->view('layout', $data);
                }
            }
        }

        function get_messages(){
            // var_dump($ReceiverId);die;
            $this->load->model('Users');
            if ($this->session->userdata('logged_in')) {
                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();
                    $this->load->model('Chats');
                    $senderID       = $user->user_id;
                    $receiverID     = $_REQUEST['receiver_id'];
                    $offset         = $_REQUEST['offset'];

                    $data   = $this->Chats->offset_retrieving($offset,$senderID,$receiverID); 
                    // var_dump($this->db->last_query());die;
                    // var_dump($data);die;
                    $html   = '';

                    foreach($data as $chat_obj){
                        // var_dump($data);die;
                        // var_dump($receiverID);die;
                        // var_dump($chat_obj->receiver_id);die;
                        // var_dump($user->user_id);die;
                        if($chat_obj->sender_id == $user->user_id)
                        {
                            $html .= "<li class='chatbox-li sender'>".$chat_obj->message."</li>";

                        }
                        // if($chat_obj->receiver_id == $receiverID)
                        else
                        {
                            $html .= "<li class='chatbox-li'>".$chat_obj->message."</li>";
                        }
                        // var_dump($this->db->last_query());die;
                    }
                    echo $html;
            }
          
            
        }
    }