<?php
if (!isset($_SESSION))
    session_start();
require("./dataBaseConnection.php");
include("./shared/header.php");
$sql = "SELECT post.title, post.description As body, post.id, users.name  FROM post JOIN users ON post.user_id = users.id";
$result = mysqli_query($conn, $sql);
$posts = array();
$comments = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $commentsQuery = "SELECT comment.description , users.name ,comment.id FROM comment JOIN users ON comment.user_id = users.id Where post_id = $id";
        $resultComment = mysqli_query($conn, $commentsQuery);
        $row['comments'] = [];
        if (mysqli_num_rows($resultComment) > 0) {
            while ($rowComment = mysqli_fetch_array($resultComment)) {
                $row['comments'][] = $rowComment;
            }
        }
        $posts[] = $row;
    }
}
if (!isset($_SESSION["userLog"])) {
    $message["success"] = "You must Login First";
    $_SESSION["message"] = $message;
    header("location:/pages/auth/login.php");
    exit();
}
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
?>
<?php
if (isset($message["error"])) {
    echo "<p class='alert alert-danger  mt-2'>" . $message["error"] . "</p>";
}
?>
<section class="mt-4">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-8 mb-4  bg-light  border rounded">
                <h3 class="my-2">
                    <?php echo $post['title']; ?>
                </h3>
                <small id="article-meta">By
                    <strong class="text-primary">
                        <?php echo $post['name'] ?>
                    </strong>
                </small>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php echo $post['body']; ?>
                    </div>
                </div>
                <form action="/createComment.php" method="POST" id="postForm">
                    <input type="text" value=<?php echo $post["id"] ?> name="id" hidden><br>
                    <label for="body">Add Comment</label>
                    <div class="input-group">
                        <input id="userText" rows="5" name="body" class="form-control">
                        <input type="submit" name='createComment' id="post-btn" class="btn btn-outline-primary mx-3"
                            value='Create'>
                        <a href="/myPosts.php" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </form>
                <div class="comments" id="comments-<?php echo $post['id']; ?>" style="display: none;">
                    <?php foreach ($post['comments'] as $comment): ?>
                        <small id="article-meta">User_name
                            <strong class="text-primary">
                                <?php echo $comment['name'] ?>
                            </strong>
                        </small>
                        <div class="input-group mb-4">
                            <input id="userText" rows="2" value="<?php echo $comment['description']; ?>" name="bodyComment"
                                class="form-control">
                            <div class="col-md-3 my-4">
                                <a href="./deleteComment.php?id=<?php echo $comment["id"]; ?>"><button
                                        class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class=" my-4 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="/pages/posts/view.php?id=<?php echo $post["id"]; ?>"><button
                                    class=" btn btn-outline-info" style="width:100%;">View</button></a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-secondary comments-btn" style="width: 100%;">Comments</button>
                        </div>
                        <div class="col-md-3">
                            <a href="/pages/posts/update.php?id=<?php echo $post["id"]; ?>"><button
                                    class="btn btn-outline-primary" style="width:100%;">Edit</button></a>
                        </div>
                        <div class="col-md-3">
                            <a href="./deletePost.php?id=<?php echo $post["id"]; ?>"><button class="btn btn-outline-danger"
                                    style="width:100%;">Delete</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-4 mb-4">
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const commentButtons = document.querySelectorAll('.comments-btn');

        commentButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const postId = button.closest('.col-md-8').querySelector('.comments').id;
                const commentsSection = document.getElementById(postId);
                commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>
<?php
include("./shared/footer.php");
?>