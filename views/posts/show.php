<?php
include("../../shared/header.php");
?>
<section class="mt-4">
<?php
if (isset($message["error"])) {
    echo "<p class='alert alert-danger col-md-8 mb-4 '>"
     . $message["error"] . "</p>";
}
?>
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
            <form action="../../controller/comment/createComment.php"
             method="POST" id="postForm">
                <input type="text" value=<?php echo $post["id"] ?>
                 name="id" hidden><br>
                <label for="body">Add Comment</label>
                <div class="input-group">
                    <input id="userText" rows="5" name="body"
                     class="form-control">
                    <input type="submit" name='createComment' id="post-btn" 
                    class="btn btn-outline-primary mx-3" value='Create'>
                    <a href="../../controller/post/myPosts.php"
                     class="btn btn-outline-danger">
                     Cancel
                    </a>
                </div>
            </form>
            <div class="comments" id="comments-<?php echo $post['id']; ?>"
             style="display: none;">
                <?php foreach ($post['comments'] as $comment): ?>
                    <small id="article-meta">User_name
                        <strong class="text-primary">
                            <?php echo $comment['name'] ?>
                        </strong>
                    </small>
                    <div class="input-group mb-4">
                        <input id="userText" rows="2" 
                            value="<?php echo $comment['description']; ?>" 
                            name="bodyComment"
                            class="form-control">
                        <div class="col-md-3 my-4">
                            <a href="../../controller/comment/deleteComment.php?
                            id=<?php echo $comment["id"]; ?>">
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class=" my-4 mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <a href="/views/posts/view.php?id=
                        <?php echo $post["id"]; ?>">
                            <button class=" btn btn-outline-info"
                             style="width:100%;">
                             View
                            </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-secondary comments-btn"
                         style="width: 100%;">
                            Comments
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="/views/posts/update.php?id=
                        <?php echo $post["id"]; ?>">
                            <button class="btn btn-outline-primary"
                             style="width:100%;">
                                Edit
                            </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="../../controller/post/deletePost.php?id=
                        <?php echo $post["id"]; ?>">
                            <button class="btn btn-outline-danger"
                             style="width:100%;">
                                Delete
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="col-md-4 mb-4">
    </div>
</div>
</section>
<?php
require("../../shared/footer.php");
?>