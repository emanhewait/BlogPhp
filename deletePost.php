<?php
if (!isset($_SESSION))
    session_start();
require("./dataBaseConnection.php");
if (isset($_GET["id"])) {
    $message = [];
    $path = "/myPosts.php";
    $deleteQuery = "DELETE FROM post Where id ='" . $_GET['id'] . "'";
    $result = mysqli_query($conn, $deleteQuery);
    if ($result) {
        $message["success"] = "Post Deleted Successfully";
    } else {
        $message["error"] = " No Delete";
    }
    $_SESSION["message"] = $message;
    header("location: $path");
} else {
    header("location: /myPosts.php");
}
?>