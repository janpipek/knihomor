<?php

require("../db.inc.php");
require("../lib.inc.php");

require_login();


$title = mysql_real_escape_string($_REQUEST["title"]);
$author_id = intval($_REQUEST["author"]);

$sql = "INSERT INTO `books` SET `title`='" . $title . "', `author_id` = '" . $author_id . "'";

$response;

if ( mysql_query($sql) )
{
	$response["success"] = true;
	$response["msg"] = "Book " . $title . " successfully created.";
}
else
{
	$response["success"] = false;
}

echo json_encode($response);