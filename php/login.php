<?php

require "db.inc.php";

$login = mysql_real_escape_string($_REQUEST["login"]);
$password = $_REQUEST["password"]; // No need to escape, it's MD5ed
$md5_password = md5($password);

$sql = "SELECT login, password FROM users WHERE login LIKE '" . $login . "'";



session_start();

$result = mysql_query($sql);
$user = mysql_fetch_object($result);

$response;
if ($user && $user->password == $md5_password)
{
	$user->password = null; // Hide even the MD5-ed value
	$_SESSION["user"] = $user; 
	$response["success"] = true;
	$response["user"] = $user;
	$response["msg"] = "Successfully logged in";
}
else
{
	$response["success"] = false;
	$response["msg"] = "Invalid user name or password";
}

echo json_encode($response);