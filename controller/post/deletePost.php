<?php
require "../../ink.php";
$message = [];
$path = "../post/myPosts.php";
$result = $postManager->deletePost($_GET['id']);
if ($result) {
    $message["success"] = "Post Deleted Successfully";
} else {
    $message["error"] = " No Delete";
}
$_SESSION["message"] = $message;
header("location: $path");
