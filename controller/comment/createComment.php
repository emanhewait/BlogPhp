<?php
require "../../ink.php";
$message = [];
$path = "../post/myPosts.php";
$formIsValid = checkForm($_POST,["body"]);
if ($formIsValid) {
    $body = nl2br($_POST["body"]);
    $body = strip_tags($_POST["body"]);
    $userId = $_SESSION["userLog"];
    $postId = $_POST['id'];
    $result = $commentManager->createComment($body,$userId,$postId);
    if ($result) {
        $message["success"] = "Comment Created Successfully.";
    }
} else {
    $message["error"] = "Comment Field Is Required";
}

$_SESSION["message"] = $message;
header("location:$path");
