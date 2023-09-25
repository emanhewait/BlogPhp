<?php
require "../../ink.php";
$formIsValid = checkForm($_POST,["title","body"]);
$path = "/views/posts/update.php?id='" . $_POST['id'] . "'";
if ($formIsValid) {
    $message = [];
    $title = $_POST["title"];
    $body = $_POST["body"];
    if (!checkInput($body)) {
        $body = nl2br($_POST["body"]);
        $result = $postManager->editPost($title,$body,$_POST['id']);
        if ($result) {
            $message["success"] = "Post Updated Successfully";
            $path = "../post/myPosts.php";
        }
    } else {
        $message["error"] = "Input Not Allow To Contain Any Tags!";
        
    }
} else {
    $message["error"] = "All Field Is Required";
}
$_SESSION["message"] = $message;
header("location: $path");
