<?php

class message extends CI_Model{
    public function get($userID){
        $date=date("Y-m-d h:i:sa",strtotime('-1 second',time()));
        $this->db->where("user_id!=",$userID);
        $this->db->where("date",$date);
        return $this->db->get('messages',50)->result();
    }
    public function getAll(){
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->join('users', 'users.user_id = messages.user_id');
        $this->db->limit(50);
        return $this->db->get()->result();
    }
    public function send($userID,$text){
        $date=date("Y-m-d h:i:sa", time());
        $data = array(
            'text' => $text,
            'user_id' => $userID,
            'date' => $date
         );
        $this->db->insert('messages', $data); 
    }

}