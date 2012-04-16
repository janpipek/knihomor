<div id="header">
  <h1>Knihomor</h1>
  <?php 
    if (!Session::current_user())
    {
      require_once "_partials/_login_form.inc.php";
    }
    else
    {
    }
  ?>
</div>