<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public $table_name;

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
    public function getData(array $like = []  , array $where = []){
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
        if(count($like) > 0)
        {
            $this->db->like( $like );    
        }
            $query = $this->db->get($this->table_name);
            return $query;
    }
    public function getDataWhereIn( $columnName = "",  array $values = [] ){
       $this->db->where_in( $columnName, $values);    
        $query = $this->db->get($this->table_name); 
            return $query;
    }
    public function getDataCondition(array $where = [] , $multiple = true , $is_array = false ){
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
        if($multiple)
        {
            if($is_array)
            {
                return $this->db->get($this->table_name)->result_array();

            }else{
                return $this->db->get($this->table_name)->result();
            }
        }else{
            if($is_array)
            {
                return $this->db->get($this->table_name)->row_array();

            }else{
                return $this->db->get($this->table_name)->row();
            }
        }
    }
    public function updateData(array $data = [], array $where = [] ){
        $query = $this->db->update($this->table_name, $data , $where );    
        return $query;
    }
    public function joins($firstTableForJoin , $joinWithColumnName , array $like = [] , array $where = []){
        if(count($like) > 0)
        {
            $this->db->like( $like );    
        }
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
        $this->db->select('*');
        $this->db->from($firstTableForJoin);
        $this->db->join($this->table_name, $firstTableForJoin.'.'.$joinWithColumnName.'='.$this->table_name.'.'.$joinWithColumnName );
        $query = $this->db->get();

        return $query;
    }
    public function multiple_joins($fetchingProjects,$where,$select){
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
        $this->db->select($select);
        $this->db->from($this->table_name);
        foreach($fetchingProjects as $fetchingProject){
            $this->db->join($fetchingProject['table_name'], $fetchingProject['column_with']);       
        }
        return $this->db->get();
    }
} 