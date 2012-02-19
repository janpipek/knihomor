<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Knihomor</title>
        <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all.css">
        <script src="extjs/ext-all.js"></script>
        <script src="app.js"></script>
    </head>
    <body id="ext">
    	<?php if (isset($_SESSION["user"])) { ?>
    		<script type="text/javascript">window.loggedIn = true;</script>
    	<?php } ?>
    </body>
</html>
