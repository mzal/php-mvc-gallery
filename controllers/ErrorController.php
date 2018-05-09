<?php
require_once '../views/NotFoundView.php';

class ErrorController {
  public function _404() {
    http_response_code(404);
    return new NotFoundView();
  }
}

