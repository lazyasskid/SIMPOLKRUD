<?php
    /*
    * App Core Class
    * Creates URL & loads Core Controller
    * URL Format - /controller/method/params
    */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $this->get_url();
        }

        public function get_url() {
            
        }
    }