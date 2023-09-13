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
if (isset($_POST["updatePost"])) {
    $formIsValid = checkForm($_POST);
    $path = "/pages/posts/update.php?id='" . $_POST['id'] . "'";
    if ($formIsValid) {
        $message = [];
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $body = $_POST["body"];
        if (!checkInput($body)) {
            $body = nl2br($_POST["body"]);
            $sql = "UPDATE post SET title='$title' , description='$body' WHERE id='" . $_POST['id'] . "'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message["success"] = "Post Updated Successfully";
                $path = "/myPosts.php";
            }
        } else {
            $message["error"] = "Input Not Allow To Contain Any Tags!";
            
        }
    } else {
        $message["error"] = "All Field Is Required";
    }
    $_SESSION["message"] = $message;
    header("location: $path");
}
?>