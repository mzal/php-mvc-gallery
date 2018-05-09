<?php
require_once '../views/GalleryView.php';
require_once '../models/Post.php';

class GalleryController {
  
  public function display() {
    $posts = Post::get_all();
    $saved = Post::load_posts(); 
    return new GalleryView($posts, $saved, false);   
  }
  
  public function save() {
    Post::save_posts();
  }

  public function personal_display() {
    $posts = Post::get_saved_by_id(); 
    $saved = [];
    return new GalleryView($posts, $saved, true); 
  }

  public function delete() {
    Post::delete_posts(); 
  }
}
