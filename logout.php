<?php

require_once "_lib.inc.php";

Session::destroy();
Request::redirect( "index.php");