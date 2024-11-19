<?php

class userController
{
    public $modelUser;
    public function __construct()
    {
        $this->modelUser = new modelUser;
    }
    function login()
    {
        require_once './views/user/formLogin.php';
        delteSessionError();
    }
    public function register()
    {
        require_once './views/user/formRegister.php';
        delteSessionError();
    }
    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $username = $_POST['username'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $date_of_birth = $_POST['date_of_birth'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $avatar = $_FILES['avatar'] ?? '';
            $errors = [];

            $regexEmail = '/^\\S+@\\S+\\.\\S+$/';
            if (empty($email)) {
                $errors['email']  = 'Không để trống email';
            } elseif (!preg_match($regexEmail, $email)) {
                $errors['email'] = 'Email không đúng định dạng example@gmail.com';
            }
            $listUser = $this->modelUser->getAllUser();
            foreach ($listUser as $key => $user) {
                if($email === $user['email']){
                    $errors['email'] = 'Email đã có người đăng ký';
                }
            }
            if (empty($username)) {
                $errors['username'] = 'Không để trống tên người dùng';
            }

            $regexPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

            if (empty($password)) {
                $errors['$password'] = 'Không để trống mật khẩu';
            } elseif (strlen($password) <= 6) {
                $errors['password'] = 'Mật khẩu cần ngắn hơn 6 ký tự';
            } elseif (strlen($password) > 30) {
                $errors['password'] = 'Mật khẩu không dài hơn 30 ký tự';
            } elseif (!preg_match($regexPassword, $password)) {
                $errors['password'] =  'Mật khẩu không đủ mạnh';
            }
            $regexPhone = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/";
            if (empty($phone)) {
                $errors['phone'] = 'Không để trống số điện thoại';
            } elseif (!preg_match($regexPhone, $phone)) {
                $errors['phone'] = 'Số điện thoại không đúng định dạng';
            }
            if (empty($date_of_birth)) {
                $errors['date_of_birth'] = 'Không để trống ngày sinh';
            }

            $arrCheckImage = ['image/png', 'image/webp', 'image/jpeg', 'image/gif'];
            if (!empty($avatar['name'])) {
                if (!in_array($avatar['type'], $arrCheckImage)) {
                    $errors['avatar'] = 'Hình ảnh chỉ được các file : .png .gif .jpg .webp';
                } elseif ($avatar['size'] > 2500000) {
                    $errors['avatar'] = 'Dung lượng tối đa 2.5MB';
                }
            }
            //  $newPass =  password_hash($password, PASSWORD_BCRYPT);
            //  debug(password_verify('123@Ab', $newPass));

            if (empty($errors)) {
                if (!empty($avatar['name'])) {
                    $link_image = uploadFile($avatar, './uploads/');
                }
                $newPass = password_hash($password, PASSWORD_BCRYPT);
                $status_default = 1; // Trạng thái hoạt động mặc định là 1
                $role_id_default = 2; //Khác hàng sẽ có quyền mặc định là 2
                $success = $this->modelUser->insertUser($username, $email, $phone, $date_of_birth, $gender, $status_default, $link_image, $role_id_default, $newPass);
                if ($success) {
                    $_SESSION['success'] = 'Đắng ký thành công !!';
                    header('location:' . BASE_URL . '?act=login');
                    exit();
                }
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL . '?act=register');
                exit();
            }
        }
    }
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Không để trống email';
            }
            if (empty($password)) {
                $errors['password'] = 'Không để trống password';
            }
            $user = $this->modelUser->getUserByEmail($email);
            if (!empty($user)) {
                if (password_verify($password, $user['password'])) {
                    $success = true;
                } else {
                    $errors['password'] = 'Mật khẩu không chính xác';
                }
            } else {
                $errors['email'] = 'Tài khoản không tồn tại';
            }

            if ($success && empty($errors)) {
                if ($user['role_id'] === 0 || $user['role_id'] === 1) {
                    $_SESSION['user'] = $user;
                    header('location:' . BASE_URL_ADMIN);
                    exit();
                } else {
                    $_SESSION['user'] = $user;
                    header('location:' . BASE_URL_CLIENT);
                    exit();
                }
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function logout()
    {
        if (!empty($_SESSION['user'])) {
            unset($_SESSION['user']);
            header('location:' . BASE_URL . '?act=login');
            exit();
        }
    }
}
