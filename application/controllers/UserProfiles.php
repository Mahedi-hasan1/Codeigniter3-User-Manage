<?php
class UserProfiles extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('UserProfile');
        $this->load->model('User');
        header('Content-Type: Application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    }
    public function index(){
        echo json_encode($this->UserProfile->getAllProfiles());
    }
    public function create(){
        $input = json_decode(file_get_contents('php://input'),true);
        $user_id = $input['user_id']??null;
        $bio = $input['bio']??null;
        $address = $input['address']??null;
        if(!$user_id){
            echo json_encode(["error"=>"user_id is required"]);
            return;
        }
        $existuser = $this->User->getUserById($user_id);
        if(!$existuser){
            echo json_encode(["error"=>"user id not found"]);
            return;
        }
        $data=[
            'user_id'=>$user_id,
            'bio'=>$bio,
            'address'=>$address
        ];
        if($this->UserProfile->addProfile($data)){
            echo json_encode(["message" => "Profile Created", "data"=>$data]);
        } else {
            echo json_encode(["error"=>"Failed to create profile"]);
        }
    }

    public function getByUserId($user_id=null){
        if(!$user_id || !is_numeric($user_id)){
            echo json_encode(["error"=> "valid user id is required"]);
            return;
        }
        $profile = $this->UserProfile->getProfileByUserId($user_id);
        if($profile){
            echo json_encode(["message"=>"successfull", "profile"=> $profile]);
        }
        else   echo json_encode(["error"=> "failed to get profile"]);
    }

    public function update($id=null){
        if(!$id || !is_numeric($id)){
            echo json_encode(["error"=> "valid id is required"]);
            return;
        }
        $existingProfile = $this->UserProfile->getProfileById($id);
        if(!$existingProfile){
            echo json_encode(["error"=> "Profile not found"]);
            return;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [];
        $user_id = $input['user_id'] ?? null;
        $existUpdateUser = $this->User->getUserById($user_id);
        if(!$existUpdateUser){
            echo json_encode(["error"=>"No user available for update requested user_id"]);
            return;
        }
        $data['user_id']=$user_id;
        if(isset($input['bio'])) $data['bio']= $input['bio'];
        if(isset($input['address'])) $data['address'] = $input['address'];

        if(empty($data)){
            echo json_encode(["error" => "No valid fields to update"]);
            return;
        }
        if($this->UserProfile->updateProfile($id, $data)){
            echo json_encode(["message"=>"Profile Updated", "data"=>$data]);
        }else{
            echo json_encode(["error" => "Failed to update profile"]);
        }
    }

    public function delete($id){
        if(!$id || !is_numeric($id)){
            echo json_encode(["error"=> "valid id is required"]);
            return;
        }
        $existingProfile = $this->UserProfile->getProfileById($id);
        if(!$existingProfile){
            echo json_encode(["error"=> "Profile not found"]);
            return;
        }
        if($this->UserProfile->deleteProfile($id)){
            echo json_encode(["message"=>"Profile Deleted"]);
        }else{
            echo json_encode(["error"=>"failed to delete Profile"]);
        }
    }
}