<?php
require "../../ink.php";
$message = [];
$path = "../../views/posts/create.php";
$formIsValid = checkForm($_POST,["title","body"]);

if ($formIsValid) {
  $title = $_POST["title"];
  $body = $_POST["body"];
  $userId = $_SESSION["userLog"];

  if (!checkInput($body)) {
    $body = nl2br($_POST["body"]);
    $result = $postManager->createPost($title,$body,$userId);
    if ($result) {
      $message["success"] = "Post Is Created Successfully .";
      $path = "../post/myPosts.php";
  }
}else{
  $message["error"] = "Input Not Allow To Contain Any Tags!";
  $path = "../../views/posts/create.php";
}
} else {
  $message["error"] = "All Field Is Required";
}
$_SESSION["message"] = $message;
header("location:$path");

