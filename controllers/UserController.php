<?php
require_once '../views/UserRegisterView.php';
require_once '../views/UserRegisterResultView.php';
require_once '../views/UserLoginView.php';
require_once '../views/UserLoginResultView.php';
require_once '../models/User.php';

class UserController {

  public function register_form() {
    return new UserRegisterView();
  }

  public function register() {
    if (isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['rep_password'])) {
      $email = $_POST['email'];
      $login = $_POST['login'];
      $password = $_POST['password'];
      $rep_password = $_POST['rep_password'];
      $user = new User($login, $password, $rep_password);
      $user->email = $email;
      $user->add();
    }
  }

  public function register_result() {
    return new UserRegisterResultView();
  }

  public function login_form() {
    if (!isset($_SESSION['user_id'])) {
      return new UserLoginView();
    } else {
      header("Location: /");
    }
  }

  public function login() {
    if (isset($_POST['login']) && isset($_POST['password'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];
      User::authenticate($login, $password);
    }
  }

  public function login_result() {
    return new UserLoginResultView();
  }

  public function logout() {
    User::logout();
  }
}
