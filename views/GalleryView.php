<?php

class GalleryView {
  private $posts;
  private $saved;
  private $personal;

  public function __construct($posts, $saved, $personal) {
    $this->posts = $posts;
    $this->saved = $saved;
    $this->personal = $personal;
  }

  public function render() {
    include '../templates/gallery.php';
  }
}
