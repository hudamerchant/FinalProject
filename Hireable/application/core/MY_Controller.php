<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';

class MY_Controller extends CI_Controller
{
    // protected $data;

    function __construct()
    {
        parent::__construct(); 
        $this->data['image_path'] = base_url('/assets/uploads/') ;
     } 
    public function search($role_id = false){

        // loading database tables for search functionalities
        $this->load->model('Projects');
        $this->load->model('PCategories');
        $this->load->model('FCategories');

        // ---  Search Freelancer Through Categories  --- //
        if (isset($_REQUEST['skill'])) 
        {
            $category  = $_REQUEST['skill'];
            if (!empty(trim($category))) {
                $like = [
                    'category' =>  $category
                ];
                $search_results = $this->FCategories->joins('categories', 'category_id', $like , 'DESC' , 'freelancer_category.updated_at')->result();
                if (!count($search_results)) {
                    $freelancers = [];
                } else {
                    foreach ($search_results as $search_result) {
                        $users[] = $search_result->user_id;
                    }
                    foreach ($users as $user) {
                        $where = [
                            'user_id' => $user
                        ];
                        $freelancers[]   = $this->Users->getData('DESC' , $where)->row();
                    }
                }
            } else {
                $whereRoleId = [
                    'role_id' => 1
                ];
                $freelancers   = $this->Users->getData('DESC' , $whereRoleId)->result();
            }
            
            $this->session->set_flashdata('search', $category);
            return $freelancers;
        }       
        // ---  Search Freelancer Through Categories  --- //
        elseif(isset($_REQUEST['required-skill']))
        {
            $category = $_REQUEST['required-skill'];
            if(!empty(trim($category)))
            {
                $like = [
                    'category' =>  $category
                ];
                $search_results = $this->PCategories->joins('categories', 'category_id', $like , 'DESC' , 'project_category.updated_at')->result();
                if($search_results == null)
                {
                    $projects = [];
                }
                else
                {
                    foreach($search_results as $search_result)
                    {
                        $project_ids[] = $search_result->project_id;
                    }
                    $project_ids = array_unique($project_ids);
                    foreach($project_ids as $project_id)
                    {
                        $where = [
                            'project_id' => $project_id
                        ];
                        $projects[]   = $this->Projects->getData('DESC' , $where)->row(); 
                    }   
                }                
            }
            else
            {
                $projects = $this->Projects->getData('DESC')->result();
            }

            $this->session->set_flashdata('search', $category);
            return $projects; 
        }
        else
        {
            if($role_id == 1)
            {
                $projects   = $this->Projects->getData('DESC' ,)->result();
                return $projects;
            }
            else
            {
                $whereRoleId = [
                    'role_id' => 1
                ];
                $freelancers   = $this->Users->getData('DESC' , $whereRoleId)->result();
            }
        }
    }
    public function upload_file($user_file){
        $config['upload_path']          = 'assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($user_file))
        {
            $response = [ 'response' => $this->upload->display_errors()];
            return $response;   
        }
        else{
            $response = ['response' => $this->upload->data()];
            return $response;   

        }
    }

    function sendMail($subject, $mailContent, string $receiver_email , string $sender_email = 'noreply@hireable.com' ){

        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host         = $this->config->item('smtp_host');
        $mail->SMTPAuth     = $this->config->item('smtp_auth');
        $mail->Username     = $this->config->item('smtp_user');
        $mail->Password     = $this->config->item('smtp_pass');
        $mail->SMTPSecure   = $this->config->item('smtp_crypto');
        $mail->Port         = $this->config->item('smtp_port');

        $mail->setFrom($sender_email);

        $mail->addAddress($receiver_email);

        $mail->Subject = $subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mail->Body = $mailContent;
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
}
