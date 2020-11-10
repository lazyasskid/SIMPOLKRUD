<?php
    class Pages extends Controller {
        public function __construct() {
            //  Load model
        }

        public function index() {
            if(isLoggedIn()) {
                redirect('posts/index');
            }
            $data = [
                'title' => 'SIMPOLKRUD',
                'description' => 'This is a simple PHP-CRUD App + Twitter Bootstrap © FBZA.'
            ];
            $this->view('pages/index', $data);
        }

        public function about() {
            $data = [
                'title' => 'About',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse egestas sem eget mollis lacinia.'
            ];
            $this->view('pages/about', $data);
        }
    }
    