<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table_name;

    function __construct()
    {
        parent::__construct();
    }
      
    public function insertRecord(array $data){
        
        $this->db->insert($this->table_name, $data);
    }
    public function whereData($data){
        $query = $this->db->get_where($this->table_name,$data)->row();
        return $query;
    }
    public function getData(array $where = [] ){
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
            $query = $this->db->get($this->table_name);
            return $query;
    }
} 