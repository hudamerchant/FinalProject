<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Comments extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->load->model('Users');
            if($this->session->userdata('logged_in')){

                $where  = [ 'email' => $this->session->userdata('user_info') ];
                $user   = $this->Users->getData('DESC',$where)->row();

                if($user->role_id == 2)
                {       
                    redirect(site_url('Client'));                    
                }
                elseif($user->role_id == 1)
                {
                    if(!$user->updated_profile)
                    {
                        return redirect(site_url('updateFProfile'));
                    }
                    else
                    {
                        $this->data['view'] = 'FProfile';
                        $this->data['site_title'] = 'Hireable';
                        $this->data['page_title'] = 'Profile -'.$this->data['site_title']; 
                      
                        $this->data['freelancer_info'] = $user;
                        
                        //loading database table client_rating
                        $this->load->model('Comment');
                        $reviews = $this->Comment->getData('DESC')->result();
                        // $this->data['review'] =$Comment; 
                         // var_dump($this->data);die;
                         $arr = [];
                        foreach ($reviews as $review) {
                          //  var_dump($review) ;die;
                            $arr[] = $review->review;
                        }
                         //var_dump($review);die;
        
        
                        $this->data['comment'] = $arr;
                        var_dump($this->data['comment'] = $arr);die;
                        if(isset($_POST['submit']))
                        
                        {
                            $this->form_validation->set_rules('review', 'Please add your reviews here', 'required');
                        }
                        // var_dump($review);die;
                        if($this->form_validation->run() == True)
                        {
                            $review = $this->input->post('review');
                            // var_dump($review);die;
                        
                            $reviewData = [
                                'review' => $review,
                                'user_id' => $user->user_id
                            ];
    
                            $this->Comment->insertRecord($reviewData);
                            $this->session->set_flashdata("reviewInserted","Review inserted successfully!");
                        // $this->load->view('layout', $this->data);
                        
                        }
                       
                        else {
                            return $this->load->view('layout', $this->data);
                        }       
                    }
                 
                } else {
                    return $this->load->view('layout', $this->data);
                }
            }
         else {
            return redirect(site_url('Login'));
    }
}
    }
?>