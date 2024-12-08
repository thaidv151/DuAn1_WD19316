<?php

class userController
{
    public $modelUser;
    public $modelOrder;
    public function __construct()
    {
        $this->modelUser = new modelUser;
        $this->modelOrder = new modelOrder;
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
                if ($email === $user['email']) {
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
            if($user['status'] !== 1){
                $_SESSION['success']= 'Tài khoản của bạn đã bị cấm vui lòng liện hệ admin để xử lý!!';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            
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
                    header('location:' . BASE_URL);
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
            session_destroy();
            header('location:' . BASE_URL . '?act=login');
            exit();
        } else {
            header('location:' . BASE_URL . '?act=login');
            exit();
        }
    }
    public function formEditProfile()
    {

        require './views/user/formEditProfile.php';
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
                    $errors['oldPassword'] = 'Mật khẩu không chính xác';
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
                $user_id = $this->modelUser->updateUser($user['id'], $username, $phone, $date_of_birth, $gender, $newAvatar, $newPass);

                $_SESSION['user'] = $this->modelUser->getUserById($user_id);
                $_SESSION['success'] = 'Cập nhật thành công';
                header('location:' . BASE_URL . '?act=edit-profile');
                exit();
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL    . '?act=edit-profile');
                exit();
            }
        }
    }
    public function clientProfile(){
        $user_id = $_GET['user_id'];
        $listOrder = $this->modelOrder->getAllOrderByUserId($user_id);
        $user = $this->modelUser->getUserById($user_id);
        
        require './views/user/profileUserView.php';
    }
}
