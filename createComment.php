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
if (isset($_POST["createComment"])) {
    $message = [];
    $path = "/myPosts.php";
    $formIsValid = checkForm($_POST);
    if ($formIsValid) {
        $body = nl2br($_POST["body"]);
        $body = strip_tags($_POST["body"]);
        $userId = $_SESSION["userLog"];
        $postId = $_POST['id'];
        $postQuery = "INSERT INTO comment(description,user_id,post_id)VALUES('$body','$userId','$postId')";
        $post = mysqli_query($conn, $postQuery);
        if ($post) {
            $message["success"] = "comment Is Created Successfully .";
        }
    } else {
        $message["error"] = "Comment Field Is Required";
    }
    $_SESSION["message"] = $message;
    header("location:$path");
}

?>