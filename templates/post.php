<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php include 'nav.php'; ?>
  <h1>
    <?= $this->post->title ?>
  </h1> 
  <p>
    <?= " " . $this->post->author ?>
  </p>
  <img src="<?= $this->post->get_watermark_path(); ?>" alt="<?= $this->post->watermark ?>" />
</body>
</html>
