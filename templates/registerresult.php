<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php include 'nav.php'; ?>
  <?php if($password_not_set): ?>
  <p>Hasła nie są takie same</p>
  <?php endif;
        if($login_taken): ?>
    <p>Login jest zajęty</p>
  <?php endif;
        if(!$login_taken && !$password_not_set): ?>
    <p>Rejestracja zakończona sukcesem</p>
  <?php endif; ?>
</body>
</html>
