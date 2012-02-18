<?php

require("../db.inc.php");
require("../lib.inc.php");

require_login();

$surname = mysql_real_escape_string($_REQUEST["surname"]);
$firstname = mysql_real_escape_string($_REQUEST["firstname"]);

$sql = "INSERT INTO `authors` SET `surname`='" . $surname . "', `firstname` = '" . $firstname . "'";

$response;

if ( mysql_query($sql) )
{
	$response["success"] = true;
	$response["msg"] = "Author " . $firstname . " " . $surname . " successfully created.";
}
else
{
	$response["success"] = false;
}

echo json_encode($response);
