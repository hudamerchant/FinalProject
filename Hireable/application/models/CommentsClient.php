
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentsClient extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = "client_rating";
    }
    
}