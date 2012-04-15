<?php

require_once "_db.inc.php";

$_autoloadLocations = array( "_models/", "_lib/");

function autoLoad($className)
{
  global $_autoloadLocations;

  foreach ($_autoloadLocations as $location) {
    $fileName = $location . strtolower($className) . ".inc.php";
    if (file_exists($fileName))
    {
      require_once($fileName);
    }
  }

}

spl_autoload_register("autoLoad");