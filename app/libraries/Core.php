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

        public function get_url() {
            echo $_GET['url'];
        }
    }