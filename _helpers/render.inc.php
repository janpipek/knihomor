<?php

function renderPartial( $partial )
{
  require_once dirname(__FILE__) . "/../_partials/" . $partial . ".inc.php";
}