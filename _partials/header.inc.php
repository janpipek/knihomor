<div id="header">
  <h1>Knihomor</h1>
  <?php 
    if (!Session::current_user())
    {
      renderPartial("login_form");
    }
    else
    {
    }
  ?>
</div>