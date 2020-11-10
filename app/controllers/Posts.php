<?php
    class Posts extends Controller {
        private $postModel;

        public function __construct() {
            // If not login, redirect to login page
            if(!isLoggedIn()) {
                redirect('users/login');
            }
            $this->postModel = $this->model('Post');
        }

        public function index() {
            // Get posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }

        public function add() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => '',
                ];
                // Validate Title
                if(empty($data['title'])) {
                    $data['title_err'] = 'Please enter title';
                }

                // Validate Body
                if(empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }

                // Make sure no errors
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    //die('success');
                    // Validated
                    if($this->postModel->addPost($data)) {
                        flash('post_added', 'Post Added!');
                        redirect('posts/index');
                    } else {
                        die('Something went wrong.');
                    }
                } else {
                    // Load view with errors
                    $this->view('posts/add', $data);
                }
            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                $this->view('posts/add', $data);
            }
        }
    }