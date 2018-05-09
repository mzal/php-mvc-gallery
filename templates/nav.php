<nav>
<ul style="list-style-type: none; display: flex; flex-direction: row">
  <li>[<a href="/">galeria</a>]</li>
  <li>[<a href="/personal">prywatna galeria</a>]</li>
  <li>[<a href="/post/new">nowy post</a>]</li>
  <?php if (!isset($_SESSION['user_id'])): ?>
    <li>[<a href="/login">logowanie</a>]</li>
    <li>[<a href="/register">rejestracja</a>]</li>
  <?php else: ?>
    <li>[<a href="/logout">wyloguj</a>]</li>
  <?php endif; ?>
</ul>
</nav>
