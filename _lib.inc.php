<?php

require_once "_db.inc.php";

// Use Prague time by default
date_default_timezone_set("Europe/Prague");

/** AUTO-LOADING MECHANISM **/
function _autoLoad($className)
{
  $_autoloadLocations = array( "_models/", "_lib/");

  foreach ($_autoloadLocations as $location) {
    $fileName = dirname(__FILE__) . "/" . $location . strtolower($className) . ".inc.php";
    if (file_exists($fileName))
    {
      require_once($fileName);
    }
  }

}
spl_autoload_register("_autoLoad");

/** LOAD ALL HELPERS **/
$_helpersDir = dirname(__FILE__) . "/_helpers";
foreach ( scandir( $_helpersDir ) as $file )
{
  if (strpos($file, ".inc.php") !== false)
  {
    require_once( $_helpersDir . "/" . $file );
  }
}

$page = new Page();