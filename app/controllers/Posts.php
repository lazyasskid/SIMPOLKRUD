<?php
    class Posts extends Controller {

        public function __construct() {
            // If not login, redirect to login page
            if(!isLoggedIn()) {
                redirect('users/login');
            }
        }

        public function index() {
            $data = [];

            $this->view('posts/index', $data);
        }
    }