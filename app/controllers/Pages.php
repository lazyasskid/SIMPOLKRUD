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
                'title' => 'About',
                'description' => 'This is a simple PHP-CRUD App + Twitter Bootstrap.'
            ];
            $this->view('pages/about', $data);
        }
    }
    