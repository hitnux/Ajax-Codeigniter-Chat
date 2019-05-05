<?php

class user extends CI_Model{
    public function getuser($username){
        return $this->db->where("name",$username)->get('users')->result();
    }
    public function getUsername($userID){
        return $this->db->where("user_id",$userID)->get('users')->result();
    }
    public function getAll(){
        return $this->db->get('users')->result();
    }
    public function find($username){
        $result=$this->getuser($username);
        if($result){
            return false;
        }else{
            return true;
        }
    }
    public function addUser($username){
        $data = array(
            'name' => $username
         );
        if($this->find($username)){
            $this->db->insert('users', $data); 
        }
        return $this->getuser($username);
    }
}