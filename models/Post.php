<?php

class Post {
  public $title;
  public $author;
  public $watermark;
  private $filename;
  public $private;
  public $_id;

  public function __construct($title, $author, $watermark){
    $this->title = $title;
    $this->author = $author;
    $this->watermark = $watermark;
  }
  public function get_thumb_path() {
    return '../images/thumb/' . $this->filename;
  }
  public function get_watermark_path() {
    return '../images/watermark/' . $this->filename;
  }
  public function add($image, $private) { 
    $this->filename = basename($image['name']);
    $this->private = $private;
    $file_path = '../web/images/orig/' . $this->filename;
    $thumb_path = '../web/images/thumb/' . $this->filename;
    $watermark_path = '../web/images/watermark/' . $this->filename;
    $invalid_format = !in_array($image['type'], ["image/jpeg", "image/png"]) && $image['error'] == UPLOAD_ERR_OK;
    $invalid_size = $image['size'] > 1000000 || $image['error'] == UPLOAD_ERR_INI_SIZE;
    if ( $invalid_format || $invalid_size || $image['error'] != UPLOAD_ERR_OK) {
      header("Location: /post/error?invalid_format={$invalid_format}&invalid_size={$invalid_size}");
    } else {
      move_uploaded_file($image['tmp_name'], $file_path);
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $type = explode('/', $finfo->file($file_path))[1];
      $this->make_thumb($file_path, $thumb_path, $type); 
      $this->make_watermark($file_path, $watermark_path, $type);
      $this->save_to_db();
      if ($this->private) {
        $this->save_post();
      }
      header("Location: /post?id={$this->_id}");
    }
  }
  private function make_thumb($src_path, $dest_path, $type) {
    $create_function = "imagecreatefrom{$type}";
    $save_function = "imagepng";
    $src_img = $create_function($src_path);
    list($src_width, $src_height) = getimagesize($src_path);
    $thumb = imagecreatetruecolor(200, 125);
    imagecopyresized($thumb, $src_img, 0, 0, 0, 0, 200, 125, $src_width, $src_height);
    $save_function($thumb, $dest_path);
    imagedestroy($thumb);
  }
  private function make_watermark($src_path, $dest_path, $type) {
    $create_function = "imagecreatefrom{$type}";
    $save_function = "imagepng";
    $img = $create_function($src_path);
    list($width, $height) = getimagesize($src_path);
    imagestring($img, 3, 10, 10, $this->watermark, 0xEEEEEE);
    $save_function($img, $dest_path);
    imagedestroy($img);
  }
  private function save_to_db() {
    $post_document = [
      "title" => $this->title,
      "author" => $this->author,
      "watermark" => $this->watermark,
      "filename" => $this->filename,
      "private" => $this->private
    ];
    if (isset( $this->_id )) {
      $post_document['_id'] = $this->_id;
    }
    $this->_id = DB::save_document("posts", $post_document);
  }
  public function get_by_id($id) {
    $post_document = DB::get_document_by_id("posts", $id);
    $this->title = $post_document['title'];
    $this->author = $post_document['author'];
    $this->watermark = $post_document['watermark'];
    $this->filename = $post_document['filename'];
    $this->private = $post_document['private'];
    $this->_id = $post_document['_id'];
  }
  private function save_post() {
    $_SESSION['saved'][] = $this->_id; 
  }
  public static function get_all() {
    $posts = [];
    $documents = DB::get_all_from_collection("posts");
    foreach($documents as $document) {
      $post = new Post('', '', '');
      $post->get_by_id($document['_id']);
      $posts[] = $post;
    }
    return $posts;
  }
  public static function save_posts() {
    $saved = [];
    foreach ($_POST as $key => $val) {
      if ($val == "on") {
        $saved[] = $key;
      } 
    }
    $_SESSION['saved'] = $saved;
    header("Location: /");
  } 
  public static function delete_posts() {
    foreach ($_POST as $key => $val) {
      if ($val = "on") {
        unset( $_SESSION['saved'][ array_search( $key, $_SESSION['saved'] ) ] );
      }
    }
    header("Location: /personal");
  }
  public static function load_posts() {
    if (isset($_SESSION['saved'])) {
      return $_SESSION['saved'];
    }
    return [];
  }
  public static function get_saved_by_id() {
    $saved = Post::load_posts();
    $posts = [];
    foreach ($saved as $id) {
      $post = new Post('', '', '');
      $post->get_by_id($id);
      $posts[] = $post;
    }
    return $posts;
  }
}
