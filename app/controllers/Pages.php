<?php
    class Pages extends Controller {
        public function __construct() {
            //  Load model
        }

        public function index() {
            $data = [
                'title' => 'SIMPOLKRUD',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            ];
            $this->view('pages/index', $data);
        }

        public function about() {
            $data = [
                'title' => 'About Us',
                'description' => 'This is a simple PHP-CRUD App.'
            ];
            $this->view('pages/about', $data);
        }
    }
    