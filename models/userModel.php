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
}
