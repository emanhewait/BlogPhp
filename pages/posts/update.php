<?php
include("../../shared/header.php");
include("../../dataBaseConnection.php");
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
if (!isset($_SESSION["userLog"])) {
    $message["success"] = "You must Login First";
    $_SESSION["message"] = $message;
    header("location:/pages/auth/login.php");
    exit();
}
$Id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id = $Id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>
<div class="row">
    <h1>Update Post</h1>
    <div class="col-md-8 col-md-offset-2">
        <br>
        <?php
        if (isset($message["success"])) {
            echo "<p class='alert alert-danger  mt-2'>" . $message["success"] . "</p>";
        }
        ?>
        <?php
        if (isset($message["error"])) {
            echo "<p class='alert alert-danger  mt-2'>" . $message["error"] . "</p>";
        }
        ?>
        <form action="/updatePost.php" method="POST" id="postForm">
            <div class="form-group">
                <input type="text" value=<?php echo $_GET['id'] ?> name="id" hidden><br>
                <input type="text" value=<?php echo $row['title'] ?> id="title" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="userText" rows="5" name="body"
                    class="form-control"><?php echo $row['description'] ?></textarea>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <input type="submit" name='updatePost' id="post-btn" class="btn btn-primary" value='Update'
                            style="width:100%;">
                    </div>
                    <div class="col-md-4">
                        <a href="/myPosts.php" class="btn btn-danger" style="width:100%;">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</main>
<?php
include("../../shared/footer.php");
?>