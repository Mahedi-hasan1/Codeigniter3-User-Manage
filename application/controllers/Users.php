<?php

class Users extends CI_Controller {
    public function __construct(){
        parent ::__construct();
        $this->load->model('User');
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }

    public function index(){
        echo json_encode($this->User->getAllUser());
    }

    public function create(){
        $input = json_decode(file_get_contents('php://input'), true);   
        // $name = $this->input->post('name');  //for urlencoded
        // $email = $this->input->post('email');
        $name  = $input['name'] ?? null;
        $email = $input['email'] ?? null;
        if(!$name || !$email){
            echo json_encode(["error" => "Name and email are required"]);
            return;    
        }
        $data = [
            'name' => $name,
            'email' => $email
        ];
        $this->User->insertUser($data);
        echo json_encode(["message"=>"User Created", "data"=>$data]);
    }
    public function update($id = null){
        if(!$id || !is_numeric($id)){
            echo json_encode(["error" => "Valid user id is required"]);
            return;
        }
        $existing = $this->User->getUserById($id);
        if(!$existing){
            echo json_encode(["error" => "User not found"]);
            return;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'] ?? null;
        $email = $input['email'] ?? null;
        if(!$name && !$email){
            echo json_encode(["error" => "At lest one field (name or email) is required"]);
            return;
        }
        $data = [];
        if($name)$data['name'] = $name;
        if($email)$data['email'] = $email;
        if($this->User->updateUser($id, $data)){
            echo json_encode(["message" => "User updated successfully", "id" => $id]);
        }
        else echo json_encode(["error" => "Failed to update user"]);
    }

    public function delete($id = null){
        if(!$id || !is_numeric($id)){
            echo json_encode(["error" => "Valid user id is required"]);
            return;
        }
        $existing = $this->User->getUserById($id);
        if(!$existing){
            echo json_encode(["error" => "User not found"]);
            return;
        }
        if($this->User->deleteUser($id)){
            echo json_encode(["message" => "User Deleted Successfully", "id"=> $id]);
        }
        else echo json_encode(["error" => "failed to delete user"]);
    }
}