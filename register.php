<?php

require "_lib.inc.php";

if (Request::isGet())
{
?>
  <form method="post">
    <?php echo captcha(); ?>
    <input type="submit" value="Pošli"/>
  </form>
<?php
} else { 
  
?>
  
<?php

}