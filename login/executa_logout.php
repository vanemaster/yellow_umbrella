<?php

include_once "comum.php";

session_destroy();
session_unset();

$_SESSION = array();

header("location: ../index/view_index.php");



?>


		