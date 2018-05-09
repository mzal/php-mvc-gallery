<?php

class UserLoginView {
  
  public function render(){
    if (isset($_GET['success'])){
      $success = $_GET['success'];
    } else {
      $success = true;
    }
    include '../templates/loginform.php';
  }
}
