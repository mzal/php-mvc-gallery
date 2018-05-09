<?php

class PostView {
  private $post;

  public function __construct($post) {
    $this->post = $post;
  }

  public function render() {
    if ($this->post->title){
      include '../templates/post.php';
    } else {
      include '../templates/notfound.php';
    }
  }
}
