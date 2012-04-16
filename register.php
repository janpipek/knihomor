<?php

include "_lib.inc.php";

if (Request::isGet()) 
{
  ?>
  <html>
    <head>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="css/application.css"/>
    </head>

    <body>
      <?php require_once "_partials/_header.inc.php"; ?>
      <?php require_once "_partials/_left.inc.php"; ?>

      <div id="main">
        <h2>Registrace nového uživatele</h2>
        <form method="post">
          <input type="text" name="login" id="login"/><label for="login">Uživatelské jméno</label><br/>
          <input type="password" name="password"/><label for="password">Heslo</label><br/>
          <input type="password" name="password_confirm"/><label for="password_confirm">Heslo ještě jednou</label><br/>
          <input type="email" name="email"/><label for="email">E-mailová adresa</label><br/>

          <?php echo captcha(); ?><br/>
          <input type="submit" value="Pošli"/>
        </form>
      </div>
    </body>
  </html>

  <?php
}
else
{

}

?>

<?php

  /*
  // REGISTER PROCESS
  if (!Request::validate_captcha()) 
  {
    exit();
  }

  $login = $_POST["login"];
  $password = $_POST["password"];
  $password_confirm = $_POST["password_confirm"];
  $nickname = $_POST["nickname"];
  $email = $_POST["email"];

  // Validate login

  
  // TODO: Validate nickname
  // TODO: Validate email


  // Validate passwords
  if ($password !== $password_confirm || $password == null)
  {
    exit();
  }
  if (!User::accept_password( $password ))
  {
    exit();
  }

  $user = new User();
  $user->login = $login
  // TODO: Create user and where to put it

*/
?>


