
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = "reviews";
    }
    
}