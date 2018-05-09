<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logowanie</title>
  <style>
    p {
      color: red;
    }
    form {
      display: flex;
      flex-direction: column;
      width: 20%;
    }
  </style>
</head>
<body>
  <?php include 'nav.php'; ?>
  <h1>Logowanie</h1>
  <?php if (!$success): ?>
    <p>Logowanie zakończone niepowodzeniem</p>
  <?php endif; ?>
  <form action="/login/submit" method="post" enctype="multipart\form-data">
    <input type="text" name="login" placeholder="login" required/>
    <input type="password" name="password" placeholder="hasło" required/>
    <input type="submit" name="submit" value="Zaloguj się"/>
  </form>
</body>
</html>
