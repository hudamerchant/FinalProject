
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentClient extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = "freelancer_rating";
    }
    
}