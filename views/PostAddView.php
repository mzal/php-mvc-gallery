<?php
  class PostAddView {
    private $logged_in;
    private $username;

    public function __construct($logged_in, $username = "") {
      $this->logged_in = $logged_in;
      $this->username = $username;
    }

    public function render() {
      if($this->logged_in) {
         $username = $this->username;
      }
      include '../templates/addpost.php';
    } 
  }
