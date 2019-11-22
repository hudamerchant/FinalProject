<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class HireFreelancer extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        function index($bid_user_id = false){
            echo $bid_user_id;
        }
    }