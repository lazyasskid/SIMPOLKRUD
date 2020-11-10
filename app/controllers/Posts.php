<?php
    class Posts extends Controller {
        private $postModel;
        private $userModel;

        public function __construct() {
            // If not login, redirect to login page
            if(!isLoggedIn()) {
                redirect('users/login');
            }
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index() {
            // Get posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }

        // Add Post
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
                        flash('post_message', 'Post Added!');
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

        // Edit Post
        public function edit($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'id' => $id,
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
                    if($this->postModel->editPost($data)) {
                        flash('post_message', 'Post Updated!');
                        redirect('posts/index');
                    } else {
                        die('Something went wrong.');
                    }
                } else {
                    // Load view with errors
                    $this->view('posts/edit', $data);
                }
            } else {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);
                // Check post owner
                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts/index');
                }
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];
                $this->view('posts/edit', $data);
            }
        }

        // Show Post
        public function show($id) {
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $data = [
                'post' => $post,
                'user' => $user
            ];
            $this->view('posts/show', $data);
        }

        // Delete Post
        public function delete($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->postModel->deletePost($id)) {
                    flash('post_message', 'Post Deleted!', 'alert alert-danger');
                    redirect('posts/index');
                } else {
                   die('Something went wrong.');
                }
            } else {
                redirect('posts/index');
            }
        }
    }