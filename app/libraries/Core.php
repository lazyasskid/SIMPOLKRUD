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
            $url = $this->get_url();

            // Look in controllers for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
            
            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            // Instantiate controller
            $this->currentController = new $this->currentController;
        }

        public function get_url() {
            if(isset($_GET['url'])) {
                // Remove forward slash
                $url = rtrim($_GET['url'], '/'); 
                // Make sure URL has no illegal characters
                $url = filter_var($url, FILTER_SANITIZE_URL); 
                // Convert URL into array
                $url = explode('/', $url);

                return $url;
            }
        }
    }