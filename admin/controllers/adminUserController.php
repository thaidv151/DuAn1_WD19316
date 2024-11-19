<?php
class adminUserController
{
    public $mdoelUser;
    public function __construct()
    {
        $this->mdoelUser = new adminUserModel;
    }
    public function formEditProfile()
    {
        require_once './views/user/formEditProfile.php';
        delteSessionError();
    }
    public function postEditProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $_SESSION['user'];
          

            $oldPassword = $_POST['oldPassword'] ?? '';
            $newPassword = $_POST['newPassword'] ?? '';
            $confirmPass = $_POST['confirmPass'] ?? '';

            $username = $_POST['username'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $date_of_birth = $_POST['date_of_birth'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $avatar = $_FILES['avatar'] ?? '';

            $errors = [];

            if (empty($username)) {
                $errors['username'] = 'Không để trống tên người dùng';
            }
            if (empty($date_of_birth)) {
                $errors['date_of_birth'] = 'Không để trống ngày sinh';
            }
            $regexPhone = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/";
            if (empty($phone)) {
                $errors['phone'] = 'Không để trống số điện thoại';
            } elseif (!preg_match($regexPhone, $phone)) {
                $errors['phone'] = 'Số điện thoại không đúng định dạng';
            }



            $regexPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

            if (!empty($oldPassword)) {

                if (password_verify($oldPassword, $user['password'])) {

                    if (!preg_match($regexPassword, $newPassword)) {
                        $errors['newPassword'] = 'Mật khẩu mới không đủ mạnh';
                    } else if (strlen($newPassword) <= 6) {
                        $errors['newPassword'] = 'Mật khẩu cần ngắn hơn 6 ký tự';
                    } elseif (strlen($newPassword) > 30) {
                        $errors['newPassword'] = 'Mật khẩu không dài hơn 30 ký tự';
                    } else {
                        if ($confirmPass === $newPassword) {
                            $newPass = password_hash($newPassword, PASSWORD_BCRYPT);
                        } else {
                            $errors['confirmPass'] = 'Mật khẩu xác nhận không chính xác';
                        }
                    }
                } else {
                    $errors['password'] = 'Mật khẩu không chính xác';
                }
            } else {
                $newPass = $user['password'];
            }
            $arrCheckImage = ['image/png', 'image/webp', 'image/jpeg', 'image/gif'];
            if (!empty($avatar['name'])) {
                if (!in_array($avatar['type'], $arrCheckImage)) {
                    $errors['avatar'] = 'Hình ảnh chỉ được các file : .png .gif .jpg .webp';
                } elseif ($avatar['size'] > 2500000) {
                    $errors['avatar'] = 'Dung lượng tối đa 2.5MB';
                }
            }

            if (empty($errors)) {

                if (!empty($avatar['name']) || $avatar['error'] === UPLOAD_ERR_OK) {
                    if (!empty($user['avatar'])) {
                        deleteFile($user['avatar']);
                    }
                    $newAvatar = uploadFile($avatar, './uploads/');
                } else {
                    $newAvatar = $user['avatar'];
                }
                $user_id = $this->mdoelUser->updateUser($user['id'], $username, $phone, $date_of_birth, $gender, $newAvatar, $newPass);
               
                $_SESSION['user'] = $this->mdoelUser->getUserById($user_id);
                $_SESSION['success'] = 'Cập nhật thành công';
                header('location:' . BASE_URL_ADMIN . '?act=edit-profile');
                exit();
            }else{
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL_ADMIN . '?act=edit-profile');
                exit();
            }
        }
    }
}
