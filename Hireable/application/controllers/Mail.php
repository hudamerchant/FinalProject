<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        // $email = $this->load->view('email');
        // return $email;
        $sender     = 'user1@email.com';
        $reciever   = 'huda@email.com';

        $this->sendMail($sender ,$reciever );
        
    }
}