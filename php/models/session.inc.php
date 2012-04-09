<?php 

require_once "../db.inc.php";
require_once "user.inc.php";

session_start();

class Session
{
  public static function create( $login, $password )
  {
    $user = User::authenticate( $login, $password );
    if ($user)
    {
      $_SESSION["user"] = $user;
      return true;
    }
    else
    {
      $_SESSION["user"] = null;
      return false;
    }
  }

  public static function currentUser()
  {
    return $_SESSION["user"];
  }

  public static function destroy()
  {
    // Implemented according http://www.php.net/manual/en/function.session-destroy.php
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    return true;
  }
}
