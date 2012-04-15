<?php

class User
{
  public static function create_password_salt_and_hash( $password )
  {
    $salt = uniqid();
    $hash = User::hash_password_and_salt( $password, $salt );
    return array( "password_salt" => $salt, "password_hash" => $hash );
  }

  private static function hash_password_and_salt( $password, $salt )
  {
    return md5( $salt . $password );
  }

  public static function check_password_validity( $password, $salt, $hash )
  {
    return ( User::hash_password_and_salt( $password, $salt ) == $hash );
  }

  public static function authenticate( $login, $password )
  {
    // Sanitize input
    $login = mysql_real_escape_string( $login );

    // Ask DB
    $sql = "SELECT * FROM users WHERE login LIKE '" . $login . "'";
    $result = mysql_query($sql);
    $user = mysql_fetch_object($result, "User");

    if (!$user)
    {
      return false;
    }

    if (User::check_password_validity( $password, $user->password_salt, $user->password_hash ))
    {
      return $user;
    }
    else
    {
      // TODO: Somehow inform of invalid attempt?
      return false;
    }
  }
}
