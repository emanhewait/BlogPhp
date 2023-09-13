<?php
include("../../shared/header.php");
require("../../dataBaseConnection.php");
$Id = $_GET['id'];
$sql = "SELECT post.title, post.description AS body, post.id, users.name FROM post JOIN users ON post.user_id = users.id WHERE post.id = $Id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$commentsQuery = "SELECT comment.description , users.name FROM comment JOIN users ON comment.user_id = users.id Where post_id = $Id";
$resultComment = mysqli_query($conn, $commentsQuery);
$row['comments'] = [];
if (mysqli_num_rows($resultComment) > 0) {
    while ($rowComment = mysqli_fetch_array($resultComment)) {
        $row['comments'][] = $rowComment;
    }
}
?>
<div class="card row" style="width: 50rem;">
    <div class="card-body bg-light">
        <h5 class="card-title ">
            <?php echo $row['title']; ?>
        </h5>
        <small id="article-meta">By
            <strong>
                <a href="">
                    <?php echo $row['name']; ?>
                </a>
            </strong>
        </small>

        <p class="card-text">
            <?php echo $row['body']; ?>
        </p>
        <h4>Comments : </h4>
        <?php foreach ($row['comments'] as $comment): ?>
            <small id="article-meta">User_name
                <strong class="text-primary">
                    <?php echo $comment['name'] ?>
                </strong>
            </small>
            <div class="card mb-4">
                <div class="card-body">
                    <?php echo $comment['description']; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class=" d-flex justify-content-center">
        <a href="/myPosts.php"><button class="btn btn-info" style="width:100% ;">Go Back</button></a>
        </div>
    </div>
</div>
<?php
include("../../shared/footer.php");
?>