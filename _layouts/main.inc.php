<?php 
  function render($page)
  {
?>

<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo relativeUrl("css/application.css"); ?>"/>
  </head>

  <body>
    <?php renderPartial("header"); ?>
    <?php renderPartial("left"); ?>
    <?php renderPartial("messages"); ?>

    <div id="main">
      <?php echo $page->content; ?>
    </div>
  </body>
</html>

<?php }