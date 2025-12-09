<?php

class User extends CI_model {

    public function getAllUser(): array{
        return $this->db->get('users')->result();
    }
    public function insertUser($data){
        return $this->db->insert('users', $data);
    }
    public function updateUser($id , $data){
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    public function deleteUser($id){
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
    public function getUserById($id){
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }


}