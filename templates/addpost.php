<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Publikacja zdjęcia</title>
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
  <h1>Publikacja zdjęcia</h1>
  <form action="/post/submit" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Tytuł" required/>
    <input type="text" name="author" placeholder="Autor" <?php if(isset($username)): ?> value="<?= $username ?>" <?php endif; ?>  required/>
    <input type="text" name="watermark" placeholder="Znak wodny" required/>
    <input type="file" name="file" required/>
    <?php if($this->logged_in): ?>
      <input type="radio" name="private" value="false" default>Publiczne</input>
      <input type="radio" name="private" value="true">Prywatne</input> 
    <?php endif; ?>
    <input type="submit" name="submit" value="Dodaj zdjęcie"/>
  </form> 
</body>
</html>
