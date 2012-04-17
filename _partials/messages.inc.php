<?php
  $messages = Session::pop_messages();
  if ($messages)
  {
    ?>
    <div id="messages">
      <?php foreach (Session::pop_messages() as $message) {
        ?>
        <div class="message"><?php echo $message; ?></div>
        <?php
      } ?>
    </div>
    <?php
  }

