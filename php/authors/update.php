<?php

// TODO: Implement, sanitize

require("../db.inc.php");

$sql = "SET `authors` SET `surname`='" . $_REQUEST["surname"] . "', `firstname` = '" . $_REQUEST["firstname"] . "' WHERE author_id=" . $_REQUEST["author_id"];

$response;

if ( mysql_query($sql) )
{
	$response["success"] = true;
	$response["msg"] = "Author " . $_REQUEST["firstname"] . " " . $_REQUEST["surname"] . " successfully created.";
}
else
{
	$response["success"] = false;
}

echo json_encode($response);