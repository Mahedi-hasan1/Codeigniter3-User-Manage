<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Hello extends CI_Controller {
    public function index(){
        echo "Hellow from CodeIgniter ";
    }
    
    public function greet() {
        echo "Hello from greet()!";
    }
}