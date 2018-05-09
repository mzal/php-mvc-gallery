<?php

  class PostErrorView {
  
    private $invalid_format;
    private $invalid_size;

    public function __construct($invalid_format, $invalid_size) {
      $this->invalid_format = $invalid_format;
      $this->invalid_size = $invalid_size;
    }

    public function render() {
      include '../templates/posterror.php';
    }
  }
