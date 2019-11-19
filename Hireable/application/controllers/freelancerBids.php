
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class freelancerBids extends MY_Controller{
        public function index(){
            $data['view'] = 'freelancerBids';
            $data['site_title'] = 'Hireable';
            $data['page_title'] = 'Bids -'.$data['site_title'];                    
            $this->load->view('layout',$data);
        }
    }

?>