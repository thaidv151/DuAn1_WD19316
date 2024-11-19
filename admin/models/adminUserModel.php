<?php
class adminUserModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function updateUser($user_id, $username, $phone, $date_of_birth, $gender, $newAvatar, $newPass){
       try {
        $sql = "UPDATE users SET username = :username,  phone = :phone, date_of_birth = :date_of_birth, gender = :gender, avatar = :newAvatar, password = :newPass  
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
    public function getUserById($id){
        try {
            $sql= "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
           }
    }
    public function getAllUserAdmin(){
        try {
            $sql= "SELECT * FROM users WHERE role_id = 1 OR role_id = 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
           }
    }
    public function getAllUserClient(){
        try {
            $sql= "SELECT * FROM users WHERE role_id = 2";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
           }
    }
    public function changeRole($user_id, $role_id){
        try {
            $sql= "UPDATE users SET role_id = :role_id WHERE id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':user_id' => $user_id,
                    ':role_id' => $role_id
                ]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
           }
    }
    public function changeStatusUser($user_id, $status){
        try {
            $sql= "UPDATE users SET status = :status WHERE id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':user_id' => $user_id,
                    ':status' => $status
                ]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
           }
    }
}