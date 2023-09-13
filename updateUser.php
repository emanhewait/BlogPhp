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
if (isset($_POST["saveUpdate"])) {
    $formIsValid = checkForm($_POST);
    $path = "/myPosts.php";
    if ($formIsValid) {
        $message = [];
        $name = $_POST["Name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $sql = "UPDATE users SET name='$name' , email='$email' , phone='$phone' , password='$password' WHERE id='" . $_POST['id'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message["success"] = "userData Updated Successfully";
            $_SESSION["userName"]=$name;
        }
    } else {
        $message["error"] = "All Field Is Required";
        $path = "/pages/auth/userUpdate.php?id='" . $_POST['id'] . "'";
    }
    $_SESSION["message"] = $message;
    header("location: $path");
}
?>