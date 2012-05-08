<?php

function renderPartial( $partial )
{
  require_once dirname(__FILE__) . "/../_partials/" . $partial . ".inc.php";
}

/*
 * File-system path to the root directory of the application
 */
function rootPath()
{
  return join(array_slice(explode("/", __FILE__), 0, -2), "/");
}

function relativeUrl( $resource )
{
    $len = strlen(rootPath()) + 1;
    $relativeScriptPath = substr($_SERVER["SCRIPT_FILENAME"], $len);
    $slashCount = substr_count($relativeScriptPath, "/");
    return str_pad("", 3 * $slashCount, "../") . $resource;
}