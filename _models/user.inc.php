<?php

class User
{
  // Reads all users from the database
  public static function all()
  {
    $sql = "SELECT * FROM users";
    $result = mysql_query($sql);
    $users = array();
    while($user = mysql_fetch_object($result, "User"))
    {
      $users[] = $user;
    }
    return $users;
  }

  // Check if the password is strong enough according to the site policy
  public static function accept_password( $password )
  {
    return (strlen( $password ) > 5);
  }

  // Check if a certain login is not taken already
  public static function login_available( $login )
  {
    // TODO: Implement
  }

  public static function create_password_salt_and_hash( $password )
  {
    $salt = uniqid();
    $hash = User::hash_password_and_salt( $password, $salt );
    return array( "password_salt" => $salt, "password_hash" => $hash );
  }

  private static function hash_password_and_salt( $password, $salt )
  {
    return sha1( $salt . $password );
  }

  public static function check_password_validity( $password, $salt, $hash )
  {
    return ( User::hash_password_and_salt( $password, $salt ) === $hash );
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

  // Save to DB
  public function create()
  {
    $sql = "INSERT INTO users (login, password_salt, password_hash, email, nickname) VALUES (";
    $sql .= "'". mysql_real_escape_string($this->login) "', ";
    $sql .= "'". mysql_real_escape_string($this->password_salt) "', ";
    $sql .= "'". mysql_real_escape_string($this->password_hash) "', ";
    $sql .= "'". mysql_real_escape_string($this->email) "', ";
    $sql .= "'". mysql_real_escape_string($this->nickname) "') ";
    echo $sql;
  }
}

/// SQL:

