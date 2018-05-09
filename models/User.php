<?php

class User {
  public $email;
  public $login;
  private $password_hash;
  private $_id;

  public function __construct($login, $password, $rep_password) {
    $this->login = $login;
    if ($password == $rep_password) {
      $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
  }

  public function add() {
    $password_not_set = !isset($this->password_hash);
    $login_taken = User::check_if_exists($this->login);
    if (!$password_not_set && !$login_taken){
      $this->save_to_db(); 
    }
    header("Location: /register/result?password_not_set={$password_not_set}&login_taken={$login_taken}");
  }

  public static function authenticate($login, $password) {
    $user_document = User::read_from_db($login);
    if ($user_document && password_verify($password, $user_document['password_hash'])) {
      session_regenerate_id();
      $_SESSION['user_id'] = $user_document['_id'];
      header("Location: /login/success");
    } else {
      header("Location: /login?success=0");
    }
  }

  public static function logout() {
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    header("Location: /");
  }

  private function save_to_db() {
    $user_document = [
      "email" => $this->email,
      "login" => $this->login,
      "password_hash" => $this->password_hash
    ];
    if (isset($this->_id)) {
      $user_document['_id'] = $this->_id;
    }
    $this->_id = DB::save_document("users", $user_document);
  }

  private static function read_from_db($login) {
     return DB::load_document("users", "login", $login);
  }

  public static function check_if_exists($login) {
    return DB::check_if_value_exists("users", "login", $login);    
  }
  public static function get_login_by_id($id) {
    return DB::value_by_id("users", "login", $id);
  }
}
