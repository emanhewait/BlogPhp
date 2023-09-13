<?php
include("../../shared/header.php");
require("../../dataBaseConnection.php");
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}

$Id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $Id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
<div class="col-lg-8">
    <?php
    if (isset($message["error"])) {
        echo "<p class='alert alert-danger  mt-2'>" . $message["error"] . "</p>";
    }
    ?>
    <div class="card mb-4">
        <div class="card-body">
            <form action="/updateUser.php" method="POST" id="userForm">
                <div class="form-group">
                    <input type="text" value=<?php echo $_GET['id'] ?> name="id" hidden><br>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" value=<?php echo $row['name'] ?> id="name" name="Name"
                                class="form-control" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">email</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" value=<?php echo $row['email'] ?> id="email" name="email"
                                class="form-control" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">phone</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" value=<?php echo $row['phone'] ?> id="phone" name="phone"
                                class="form-control" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">password</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" value=<?php echo $row['password'] ?> id="password" name="password"
                                class="form-control" />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <input type="submit" name='saveUpdate' id="post-btn" class="btn btn-primary"
                                    value='Save' style="width:100%;">
                            </div>
                            <div class="col-md-4">
                                <a href="/myPosts.php" class="btn btn-danger" style="width:100%;">Cancel</a>
                            </div>
                        </div>
            </form>
            <?php
            include("../../shared/footer.php");
            ?>