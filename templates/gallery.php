<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Galeria lisów</title>
  <style>
    div {
      display: flex;
      flex-wrap: wrap;
      width: 100%;
    }
    figure {
      border: 1px dashed indigo;
    }
    p {
      font-size: 12px;
      text-align: center;
    }
  </style>
</head>
<body>
  <?php include 'nav.php'; ?>
  <h1>Galeria lisów</h1>
  <?php if ($this->personal): ?>
    <form action="/delete" method="post" enctype="multipart\form-data" id="delete_form"/>
  <?php else: ?>
    <form action="/save" method="post" enctype="multipart\form-data" id="save_form"/>
  <?php endif; ?>
  <div>
    <?php foreach ($this->posts as $post): ?>
      <?php if( (!$this->personal && !$post->private) || $this->personal): ?>
        <figure>
          <a href="<?= '/post?id=' . $post->_id ?>" >
            <img src="<?= $post->get_thumb_path() ?>" alt="<?= $post->title ?>" />
          </a>
          <p>
            <i><?= $post->title ?></i>
          </p>
          <p>
            <?= $post->author ?>
          </p>
          <?php if($this->personal): ?>
            <input type="checkbox" form="delete_form" name="<?= $post->_id ?>" >
            <?php if($post->private): ?>
              <span>prywatne</span>
            <?php endif; ?>
          <?php else: ?>
            <input type="checkbox" form="save_form" name="<?= $post->_id ?>" <?php if (in_array($post->_id, $this->saved)): ?> checked <?php endif; ?> >
          <?php endif; ?>
        </figure>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <?php if($this->personal): ?>
    <input type="submit" name="submit" form="delete_form" value="Usuń zaznaczone z zapamiętanych"/>
  <?php else: ?>
    <input type="submit" name="submit" form="save_form" value="Zapamiętaj wybrane"/>
  <?php endif; ?>
</body>
</html>
