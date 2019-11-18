<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Search extends MY_Controller{
        public function index(){
            $data['view'] = 'Search';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Search - '.$data['site_title'];
            $this->load->view('layout',$data);
    
        }
    }

?>