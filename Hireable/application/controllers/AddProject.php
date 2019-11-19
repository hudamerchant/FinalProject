
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddProject extends MY_Controller{
        public function index(){
            $data['view'] = 'AddProject';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Add project -'.$data['site_title'];  
            
            //loading database table categories
            $this->load->model('Categories');
            $categories         = $this->Categories->getData()->result();
            $data['categories'] = $categories;
            $this->load->view('layout',$data);
        }
    }

?>