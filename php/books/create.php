<?php

require("../db.inc.php");
require("../lib.inc.php");

require_login();

$title = mysql_real_escape_string($_REQUEST["title"]);
if ( isset($_REQUEST["author"]) )
{
	$author_id = intval($_REQUEST["author"]);	
}
else
{
	$author_id = null;
}

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
	$response["msg"] = "Could not add book";
}

echo json_encode($response);
