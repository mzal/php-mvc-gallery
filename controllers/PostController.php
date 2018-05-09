<?php
  require_once '../models/Post.php';
  require_once '../models/User.php';
  require_once '../views/PostView.php';
  require_once '../views/PostAddView.php';
  require_once '../views/PostErrorView.php'; 

  class PostController {

    public function display() {
      $post = new Post('', '', '');
      if (isset($_GET['id'])) {
        $post->get_by_id($_GET['id']);
      }
      return new PostView($post);
    }
    public function new() {
      $logged_in = false;
      $username = "";
      if (isset($_SESSION['user_id'])) {
        $logged_in = true;
        $username = User::get_login_by_id($_SESSION['user_id']);
      }

      return new PostAddView($logged_in, $username); 
    }

    public function submit() {
      if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['watermark']) && isset($_FILES['file'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $watermark = $_POST['watermark'];
        $file = $_FILES['file'];
        if (isset($_POST['private'])) {
          $private = $_POST['private'];
        } else {
          $private = false;
        }
        $post = new Post($title, $author, $watermark);        
        $post->add($file, $private);
      }
    }

    public function post_error() {
      $invalid_format = $_GET['invalid_format'];
      $invalid_size = $_GET['invalid_size'];
      return new PostErrorView($invalid_format, $invalid_size);
    }
  }
