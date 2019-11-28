<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Userchat extends MY_Model
{
    function add_message($message)
    {
        $data = array(
            'message'   => (string) $message,
            'created_at' => time(),
        );
          
        $this->db->insert('chats', $data);
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
