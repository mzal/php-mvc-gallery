<?php

class UserRegisterResultView {

  public function render(){
    $password_not_set = $_GET['password_not_set'];
    $login_taken = $_GET['login_taken'];
    include '../templates/registerresult.php';
  }
}
