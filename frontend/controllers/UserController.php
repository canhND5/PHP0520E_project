<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';

class UserController extends Controller
{
    //chức năng liêt
//    chức năng đăng ký: index.php?controller=user&action=register
    public function register()
    {
        //xử lý submit form
        //debig mảng $_POST
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        //nếu user submit form thì mới xử lý
        if (isset($_POST['register'])) {
            //+ tạo biến
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            //validate form: các trường ko dk để trông, 2 MK phải trùng nhau
            if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
                $this->error = 'Các trường ko dk để trống';
            } elseif ($confirm_password != $password) {
                $this->error = 'Mật khẩu phải trùng nhau';
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->error = 'Email không đúng định dạng';
            }

            //xử lý logic khi ko có lỗi xảy ra
            if (empty($this->error)) {
                //Kiểm tra xem username đã tồn tại trong CSDL hay ko
                //phải cần gọi model để truy vấn CSDL
                $user_model = new User();
                $user_model->username = $username;
                $is_exist_username = $user_model->isExistUsername($username);
//                var_dump($is_exist_username);
                //cần mã hóa MK trước khi so sánh với trường password trong bảng, sử dụng mã hóa md5(password)
                $password = md5($password);
                if ($is_exist_username) {
                    $this->error = 'Username này đã tồn tại';
                } else {
                    //đăng ký user
                    $is_register = $user_model->register($username,$password,$email);
                    if ($is_register){
                        $_SESSION['success'] = 'Đăng ký thành công';
                        header('Location: index.php?controller=user&action=login');
                        exit();
                    }else{
                        $this->error = 'Có lỗi ko thể đăng ký';
                    }
                }
            }

        }
        //lấy nội dung file view register
        $this->content = $this->render('views/users/register.php');
        //+gọi lay out để hiển thị nôi dung
        //Do giao diện chức năng đăng ký khác vs giao diện chính backend, nên tạo 1 file layout mới
//        trong views/layouts/main_login.php
        //copy layout main.php -> main_login.php, sau đó chỉnh sử
        require_once 'views/layouts/main.php';
    }

    //phương thức login
    public function login(){
        //xử lý submint form
        //debug mảng $_POST
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        //nếu submit mới xử lý
        if (isset($_POST['login'])){
            //tạo biến va gán giá trị
            $username = $_POST['username'];
            $password = $_POST['password'];
            //validate: ko dk để trông
            if(empty($username) || empty($password)){
                $this->error = 'Ko dk để trông';
            }
            //xử lý logic nếu ko có lỗi xảy ra
            if(empty($this->error)){
                //xử lý login
                $user_model = new User();
                //với chức năng đăng nhập thì ko trả về trua fales, vì khi đăng nhập, mà cần trả về đối
                // tượng user tương ứng, để hiển thị trong giao diện admin, khi đăng nhập thành công sẽ dùng biến
                //secton để lưu lẠI ĐỐI TƯỢNG
                //cần mã hóa password theo đúng cơ chế đã lưu trong CSDL
                $password = md5($password);
                $user = $user_model->getUser($username,$password);

                if (!empty($user)){
                    $_SESSION['user'] = $user;
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    header('Location: index.php?controller=product&action=showAll');
                    exit();
                }else{
                    $this->error = 'Sai tài khoản hoặc mật khẩu';
                }
            }

        }

        //lấy nội dung views tương ứng
        $this->content = $this->render('views/users/login.php');
        //gọi layout
        require_once 'views/layouts/main.php';
    }

    public function update() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);
        if (isset($_POST['submit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
                $user_model->status = $status;
                $is_update = $user_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=user');
                exit();
            }
        }

        $this->content = $this->render('views/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }
    //profile user
    public function profile(){

//        if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
//            header("Location: index.php?controller=user");
//            exit();
//        }
//echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//echo "</pre>";
        $id = $_SESSION['user']['id'];
        $user_model = new User();
        $user = $user_model->getById($id);
        if (isset($_POST['update'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
//            $status = $_POST['status'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads =  '../backend/assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
//                $user_model->status = $status;
                $is_update = $user_model->updateProfile($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                $user = $user_model->getById($id);
                $_SESSION['user'] = $user;

//                header('Location: index.php?controller=user');
//                exit();
            }
        }
        //lấy views
        $this->content = $this->render('views/users/profile.php');
        require_once 'views/layouts/main.php';
    }

    public function logout(){
        if (isset($_SESSION['user'])){
            unset($_SESSION['user']);
            $_SESSION['success'] = 'Đăng xuất thành công, vui lòng đăng nhập khi mua hàng để nhận được nhiều tiện ích và ưu đã';

        }
        header('Location: index.php');
        exit();

    }
}
