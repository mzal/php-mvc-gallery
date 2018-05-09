<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rejestracja</title>
  <style>
    form {
      display: flex;
      flex-direction: column;
      width: 20%;
    }
  </style>
</head>
<body>
  <?php include 'nav.php'; ?>
  <h1>Rejestracja użytkownika</h1>
  <form action="/register/submit" method="post" enctype="multipart/form-data">
    <input type="email" name="email" placeholder="adres e-mail" required/>
    <input type="text" name="login" placeholder="login" required/>
    <input type="password" name="password" placeholder="hasło" required/>
    <input type="password" name="rep_password" placeholder="powtórz hasło" required/>
    <input type="submit" name="submit" value="Zarejestruj"/>
  </form>
</body>
</html>
