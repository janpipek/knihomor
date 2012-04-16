<?php
function captcha()
{
  $s = "<input type='text' name='captcha' id='captcha'>";
  $s .= "<label for='captcha'>Zadejte, který rok se bude psát za 12 měsíců (čísly).</label><br/>";
  return $s;
}
?>