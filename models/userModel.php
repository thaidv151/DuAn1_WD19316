<?php
class modelUser
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function insertUser(
        $username,
        $email,
        $phone,
        $date_of_birth,
        $gender,
        $status_default,
        $link_image,
        $role_id_default,
        $newPass
    ) {
        try {
            $sql = "INSERT INTO users ( username, email, phone, date_of_birth, gender, status, avatar, role_id, password, created_at) 
                VALUES ( :username, :email, :phone, :date_of_birth, :gender, :status_default, :link_image, :role_id_default, :newPass, now())";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':username' => $username,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':date_of_birth' => $date_of_birth,
                    ':gender' => $gender,
                    ':status_default' => $status_default,
                    ':link_image' => $link_image,
                    ':role_id_default' => $role_id_default,
                    ':newPass' => $newPass
                ],
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email,
                ]
            );

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getAllUser()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function updateUser($user_id, $username, $phone, $date_of_birth, $gender, $newAvatar, $newPass)
    {
        try {
            $sql = "UPDATE users SET username = :username,  phone = :phone, date_of_birth = :date_of_birth, gender = :gender, avatar = :newAvatar, password = :newPass , update_at = now() 
         WHERE id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':username' => $username,
                ':phone' => $phone,
                ':date_of_birth' => $date_of_birth,
                ':gender' => $gender,
                ':newAvatar' => $newAvatar,
                ':newPass' => $newPass
            ]);
            return $user_id;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
