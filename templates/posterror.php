<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php include 'nav.php'; ?>
  <?php if ($this->invalid_format):?>
    <p>The format of the file is invalid. Only PNG and JPG files are allowed.</p>
  <?php endif;
        if ($this->invalid_size):?>
    <p>The file size is too large. Maximum allowed size is 1MB</p>
  <?php endif; ?>
  <?php if (!$this->invalid_size && !$this->invalid_format):?>
    <p>An upload error has occured</p>
  <?php endif; ?>
</body>
</html>
