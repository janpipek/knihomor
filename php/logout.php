<?php

session_start();
session_destroy();

$response["success"] = true;
$response["msg"] = "Successfully logged out";

echo json_encode($response);