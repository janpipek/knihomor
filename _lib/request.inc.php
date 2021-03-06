<?php

class Request
{
  public static function isGet()
  {
    return ( $_SERVER["REQUEST_METHOD"] === "GET" );
  }

  public static function isPost()
  {
    return ( $_SERVER["REQUEST_METHOD"] === "POST" );
  }

  public static function redirect( $url )
  {
    header( "Location: " . $url );
    exit(0);
  }

  // TODO: Implement isAjax()

  /*
   * Validate captcha input (should be equal to year + 1)
   * 
   * Complementary function you will find in _helpers/forms
   */
  public static function validate_captcha()
  {
    if (!array_key_exists("captcha", $_REQUEST))
    {
      return false;
    }
    else
    {
      $nextYear = date("Y") + 1;
      return ($nextYear === intval($_REQUEST["captcha"]));
    }
  }
}