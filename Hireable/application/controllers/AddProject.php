
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AddProject extends MY_Controller{
        public function index(){
            $data['view'] = 'AddProject';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Add project -'.$data['site_title'];                    
            $this->load->view('layout',$data);
        }
    }

?>