<?php
class PostManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createPost($title, $body, $userId) {
        return $this->conn->prepare("INSERT INTO post (title, description, user_id)
         VALUES (:title, :description, :user_id)")->execute([
            ':title' => $title,
            ':description' => $body,
            ':user_id' =>$userId
        ]);
    }
    public function showPost($postId) {
        $stmt = $this->conn->prepare("SELECT post.title, post.description 
        AS body, post.id, users.name
        FROM post
        JOIN users ON post.user_id = users.id
        WHERE post.id = :post_id");
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_BOTH);
        $stmtComment = $this->conn->prepare("SELECT comment.description, users.name
        FROM comment
        JOIN users ON comment.user_id = users.id
        WHERE post_id = :id");
        $stmtComment->bindParam(':id', $postId);
        $stmtComment->execute();
        $row['comments'] = [];

        if ($stmtComment->rowCount() > 0) {
            while ($rowComment = $stmtComment->fetch(PDO::FETCH_ASSOC)) {
                $row['comments'][] = $rowComment;
            }
        }

        return $row;
    }

    public function showPosts() {
        $result = $this->conn->query("SELECT post.title, post.description 
        AS body, post.id, users.name 
        FROM post JOIN users ON post.user_id = users.id");
        $count = $result->rowCount();
        $posts = array();
        if ($count > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $stmt = $this->conn->prepare("SELECT comment.description, users.name, comment.id 
                FROM comment JOIN users ON comment.user_id = users.id 
                WHERE post_id = $id");
                $stmt->execute();
                $row['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $posts[] = $row;
            }
        }
        return $posts;
    }
    
    public function getPost($id) {
        $stmt = $this->conn->prepare("SELECT * FROM post WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);  
    }

    public function editPost($title, $body, $postId) {
        return $this->conn->prepare("UPDATE post 
        SET title=:title , description=:description 
        WHERE id=:post_id")->execute([
            ':title' => $title,
            ':description' => $body,
            ':post_id' => $postId
        ]);
    }

    public function deletePost($postId) {
        return $this->conn->prepare("DELETE FROM post WHERE id = :id")
        ->execute([
            ':id' => $postId
        ]);
    }
}
