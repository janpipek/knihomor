<?php

require_once "../_lib.inc.php";

$users = User::all();

?>

<table>
  <?php
    foreach( $users as $user )
    {
      ?>
        <tr>
          <td><?php echo($user->nickname); ?></td>
        </tr>
      <?php
    }
  ?>
</table>