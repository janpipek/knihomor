<div id="left">
  <?php if (Session::current_user()) { ?>
    <ul id="main-menu">
      <li><a href="books">Knihy</a></li>
      <li><a href="people">Lidé</a></li>
      <li><a href="logout.php">Odhlásit</a></li>
    </ul>
  <?php } else { ?>
    <ul id="main-menu">
      <li><a href="index.php">Hlavní stránka</a></li>
      <li><a href="register.php">Registrace nového uživatele</a></li>
    </ul>
  <?php } ?>
</div>