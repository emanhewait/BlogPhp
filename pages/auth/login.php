<?php
include("../../shared/header.php");
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
if (isset($_SESSION["userLog"])) {
    header("location:/myPosts.php");
    exit();
}

?>
<br>.<br>.<br>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-form">
            <?php if (isset($message["success"])) {
                echo "<p class='alert alert-primary  mt-2'>" . $message["success"] . "</p>";
            }
            ?>
            <form action="/auth.php" method="POST">
                <h2 class="text-center">Login</h2>
                <div class="form-group">
                    <input type="text" name='email' class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name='password' class="form-control" placeholder="Password">
                    <?php if (isset($message["error"])) {
                        echo "<p class='alert alert-danger text-center mt-2'>" . $message["error"] . "</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" name="loginForm" value="Login">
                </div>
                <div class="clearfix text-center">
                    <label> Not A Member ?..</label>
                    <a href="/pages/auth/register.php">Register</a>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
include("../../shared/footer.php");
?>