<?php
function captcha()
{
  $s = "<input type='text' name='captcha' id='captcha'>\n";
  $s .= "<label for='captcha'>Zadejte, který rok se bude psát za 12 měsíců (čísly).</label>\n";
  return $s;
}

function validate_captcha()
{
  if (!array_key_exists("user", $_REQUEST))
  {
    return false;
  }
  else
  {
    $nextYear = date("Y") + 1;
    return ($nextYear === intval($_REQUEST));
  }
}
?>