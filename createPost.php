<?php
if (!isset($_SESSION))
  session_start();

require("./dataBaseConnection.php");
function checkForm($array)
{
  foreach ($array as $key => $value) {
    if (!isset($array[$key]) || empty($value)) {
      return 0;
    }
  }
  return 1;
}
function checkInput($input)
{
    $notAllowedCharacter = ['<', '>', '&'];

    foreach ($notAllowedCharacter as $char) {
        if (strpos($input, $char) !== false) {
            return true;
        }
    }

    return false;
}
if (isset($_POST["createPost"])) {
  $message = [];
  $path = "/pages/posts/create.php";
  $formIsValid = checkForm($_POST);
  if ($formIsValid) {
    $title = mysqli_real_escape_string($conn,$_POST["title"]);
    $body = $_POST["body"];
    $userId = $_SESSION["userLog"];
    if (!checkInput($body)) {
      $body = nl2br($_POST["body"]);
    $postQuery = "INSERT INTO post(title,description,user_id)VALUES('$title','$body','$userId')";
    $post = mysqli_query($conn, $postQuery);
    if ($post) {
      $message["success"] = "Post Is Created Successfully .";
      $path = "/myPosts.php";
    }
  }else{
    $message["error"] = "Input Not Allow To Contain Any Tags!";
    $path = "/pages/posts/create.php";
  }
  } else {
    $message["error"] = "All Field Is Required";
  }
  $_SESSION["message"] = $message;
  header("location:$path");
}

?>