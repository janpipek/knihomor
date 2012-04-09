<?php

session_start();

// If user is not logged in (session with user),
// send failure message and immediatelly exit.
function require_login() {
	if (!session_id() || !isset($_SESSION["user"])) {
		$response;
		$response["success"] = false;
		$response["msg"] = "Not logged in";

		echo json_encode($response);

		exit();
	}
}