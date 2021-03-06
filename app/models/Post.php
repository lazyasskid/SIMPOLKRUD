<?php
    class Post {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Get Posts
        public function getPosts() {
            $this->db->query('SELECT *, posts.id as postId, users.id as userId, posts.created_at as postCreated, users.created_at as userCreated FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');
            return $this->db->resultSet();
        }

        // Add Post
        public function addPost($data) {
            // Query
            $this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
            // Bind Values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Edit Post
        public function editPost($data) {
            // Query
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            // Bind Values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get Post By ID
        public function getPostById($id) {
            // Query
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            // Bind Values
            $this->db->bind(':id', $id);

            return $this->db->single();
        }

        // Delete Post By ID
        public function deletePost($id) {
            // Query
            $this->db->query('DELETE FROM posts WHERE id = :id');
            // Bind Values
            $this->db->bind(':id', $id);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
