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
    exit(0);
    // TODO: Authentication OK
    // Redirect to index(?)
  }
  else
  {
    // TODO: Authentication failed
    // Redirect to index
  }
  Request::redirect( "index.php" );
}