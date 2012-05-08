<div id="left">
  <?php if (Session::current_user()) { ?>
    <ul id="main-menu">
      <li><a href="<?php echo relativeUrl("books"); ?>">Knihy</a></li>
      <li><a href="<?php echo relativeUrl("people"); ?>">Lidé</a></li>
      <li><a href="<?php echo relativeUrl("logout.php"); ?>">Odhlásit</a></li>
    </ul>
  <?php } else { ?>
    <ul id="main-menu">
      <li><a href="<?php echo relativeUrl("index.php"); ?>">Hlavní stránka</a></li>
      <li><a href="<?php echo relativeUrl("register.php"); ?>">Registrace nového uživatele</a></li>
    </ul>
  <?php } ?>
</div>