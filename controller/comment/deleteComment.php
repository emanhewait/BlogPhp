<?php
require "../../ink.php";
$message = [];
$path = "../post/myPosts.php";
$result = $commentManager->deleteComment($_GET['id']);
if ($result) {
    $message["success"] = "comment Deleted Successfully";
} else {
    $message["error"] = " No Delete";
}
$_SESSION["message"] = $message;
header("location: $path");
