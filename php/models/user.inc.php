<?php

class User
{
  public static function create_password_salt_and_hash( $password )
  {
    $salt = uniqid();
    $hash = User::hash_password_and_salt( $password, $salt );
    return array( "password_salt" => $salt, "password_hash" );
  }

  public static function hash_password_and_salt( $password, $salt )
  {
    return md5( $salt . $password );
  }

  public static function check_password_validity( $password, $salt, $hash )
  {
    return ( User::hash_password_and_salt( $password, $salt ) == $hash );
  }
}

