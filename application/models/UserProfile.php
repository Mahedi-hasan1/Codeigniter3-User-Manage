<?php
class UserProfile extends CI_model{
    public function addProfile($data){
        return $this->db->insert('userprofile', $data);
    }
    public function getAllProfiles(){
        return $this->db->get("userprofile")->result();
    }
    public function getProfileByUserId($userId){
        return $this->db->where('user_id', $userId)->get('userprofile')->row();
    }
    public function getProfileById($id){
        return $this->db->get_where('userprofile', ['id' => $id])->row();
    }
    public function updateProfile($id, $data){
        return $this->db->where('id',$id)->update('userprofile',$data);
    }
    public function deleteProfile($id){
        return $this->db->where('id', $id)->delete('userprofile');
    }
}