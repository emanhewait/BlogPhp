<?php
class CommentManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createComment($body, $userId, $postId) {
        $sql = "INSERT INTO comment (description, user_id, post_id) 
        VALUES (:description, :user_id, :post_id)";
        return $this->conn->prepare($sql)->execute([
            ':description' => $body,
            ':user_id' => $userId,
            ':post_id' => $postId
        ]);
    }

    public function deleteComment($commentId) {
        return $this->conn->prepare("DELETE FROM comment WHERE id = :id")
        ->execute([
            ':id' => $commentId
        ]);
    }
}