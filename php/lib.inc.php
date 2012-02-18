<?php

session_start();

function require_login() {
	if (!session_id() || !isset($_SESSION["user"])) {
		$response;
		$response["success"] = false;
		$response["msg"] = "Not logged in";

		echo json_encode($response);

		exit();
	}
}