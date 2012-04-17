<?php

require_once "_lib.inc.php";

$login = $_POST["login"];
$password = $_POST["password"];

if (!$login || !$password)
{
  // TODO: Message
  exit(0);
}
else
{
  if (Session::create($login, $password))
  {
    Session::post_message("Uživatel úspěšně přihlášen.");
  }
  else
  {
    Session::post_message("Neplatné uživatelské jméno nebo heslo.");
  }
  Request::redirect( "index.php" );
}