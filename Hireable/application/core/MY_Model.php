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
    public function getData($order = 'ASC' , array $where = [] , array $like = []){
        $this->db->order_by('updated_at' , $order);
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
    public function joins($firstTableForJoin , $joinWithColumnName , array $like = [] ,$order = 'ASC',$orderby = "", array $where = []){
        $this->db->order_by($orderby , $order);
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
    public function multiple_joins($JoinWith,$where,$select, $order = 'ASC',$orderby = "" , $join = 'join' ){
        $this->db->order_by($orderby , $order);
        if(count($where) > 0)
        {
            $this->db->where( $where );    
        }
        $this->db->select($select);
        $this->db->from($this->table_name);
        foreach($JoinWith as $JoinWithValue){
            $this->db->join($JoinWithValue['table_name'], $JoinWithValue['column_with'] , $join);       
        }
        
        return $this->db->get();
    }
    public function deleteData(array $where = []){
        if(count($where) > 0)
        {
            $this->db->where($where);
        }
        $query = $this->db->delete($this->table_name);
        return $query; 
    }
    public function retrieve_ratings( $order='ASC', $select = '*', array $where = []){
        $this->db->order_by('updated_at' , $order);
        $this->db->select($select);
        $this->db->from($this->table_name);
        if(count($where) > 0){
            $this->db->where($where);
        }
        return $this->db->get()->row_array();
    }
    public function offset_retrieving($offset= 0 , $sender_id , $receiver_id, $limit = 100000000000 )
    {
         
        $OR = 'OR';
        $where1  = 'sender_id = '.$sender_id.' AND receiver_id = '.$receiver_id;
        $where2  = 'sender_id = '.$receiver_id.' AND receiver_id = '.$sender_id;
        return $this->db->where($where1)
                        ->or_where($where2)
                        ->limit($limit,$offset)
                        ->get('chats')->result(); 
        // $OR = 'OR';
        // $where  = [
        //     'sender_id'   => $sender_id,
        //     'receiver_id' => $receiver_id
        // ];
        // return $this->db->where($where)
        //                 ->limit($limit,$offset)
        
    }
    public function inserting($data){
        $this->db->insert('chats',$data);
    }
    function get_messages($timestamp)
    {
        $this->db->where('timestamp >', $timestamp);
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(10); 
        $query = $this->db->get('chats');
        
        return array_reverse($query->result_array());
    }
} 