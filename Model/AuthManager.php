<?php
class AuthManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function register($username, $email, $phone, $password) {
        return $this->conn->prepare("INSERT INTO users(name, email, phone, password)
        VALUES(:name, :email, :phone, :password)")->execute([
            ':name' => $username,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $password
        ]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users 
        WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users 
        WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);
    }

    public function updateUser($name, $email, $phone, $password, $postId) {
        return $this->conn->prepare("UPDATE users 
        SET name=:name , email=:email , phone=:phone , password=:password 
        WHERE id=:post_id")->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $password,
            ':post_id' => $postId
        ]);
    }       
}
