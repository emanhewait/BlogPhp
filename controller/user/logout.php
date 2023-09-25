<?php
require ("../../ink.php");
unset($_SESSION["userLog"]);
$_SESSION["message"] = "You've Signed out.";
header("location:/views/auth/login.php");

