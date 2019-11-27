<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->load->helper('other_helper');
        echo sendMail();
    }
}