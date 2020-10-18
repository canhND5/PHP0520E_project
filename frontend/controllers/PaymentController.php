<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'helpers/Helper.php';
require_once 'models/User.php';
require_once 'models/Product.php';

class PaymentController extends Controller
{
    public function index()
    {
        //xử lý submit form
        //+Debug thông tin biến $_POST
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        //login để điền form nhanh hơn
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
                    $_SESSION['success'] = 'Đăng nhập thành công, vui lòng xác nhận lại thông tin của bạn đã chính xác chưa.';
                    header('Location: thanh-toan.html');
                    exit();
                }else{
                    $this->error = 'Sai tài khoản hoặc mật khẩu';
                }
            }

        }

        //kiểm tra nếu user submit mới xử lý
        if (isset($_POST['submit'])) {
            //tạo biến
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $method = $_POST['method'];
            //validte form
            //các trương name email, address, moblie ko dk để trống
            // Trướng emal phải đúng định dạng
            if (empty($fullname) || empty($address) || empty($mobile) || empty($email)) {
                $this->error = 'Fullname, address, mobile, email ko dk để trống';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'email ko đúng định dạng';
            }
            //xử lý lưu thông tin đơn hàng chỉ khi ko có lỗi xay ra
            if (empty($this->error)) {
                //lưu lại thông tin đơn hàng vào bảng order và order_detail
                $order_model = new Order();
                //gán các giá trji của form cho các thuộc tính của đối tượng vuawaf tạo
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->note = $note;
                //tính tổng giá trị đơn hàng
                $price_total = 0;

                foreach ($_SESSION['cart'] as $cart) {
                    $total_item = $cart['price'] * $cart['quantity'];
                    $price_total += $total_item;
                }
                $order_model->price_total = $price_total;
                //mặc định là chưa thanh toán
                $order_model->payment_status = 0;
                //gọi phương thức insert
                $order_id = $order_model->insert();
//                var_dump($order_id);
                //xử lý lưu trong vòng lặp giở hàng
                foreach ($_SESSION['cart'] as $product_id => $cart) {
                    //khỏi tạo đối tượng từ model ordelDetail
                    $order_detail_model = new OrderDetail();
                    $order_detail_model->order_id = $order_id;
                    $order_detail_model->product_id = $product_id;
                    $order_detail_model->quantity = $cart['quantity'];
                    //gọi phương thức inseret
                    $is_insert = $order_detail_model->insert();
//                    var_dump($is_insert);
                    //update số lượng còn lại của sản phẩm
                    $product_model = new Product();
                    $product = $product_model->getById($product_id);
                    $product['amount'] -= $cart['quantity'];
                    $is_update_amount = $product_model->updateAmount($product_id, $product['amount']);
                    var_dump($is_update_amount);
                }
                //gửi mail cho khách hàng về thông tin đơn hàng
                //Sử dụng phương thức tĩnh sendMail của class Helper
                //+khai báo các giá trị để truyền vào PH sendMail
                $subject = "Từ ABC.com - Thông tin đơn hàng của bạn";
                $username = 'canhhp95@gmail.com';
                $password = 'erbnvgaaxedwcvzy';
                $info_customer = [
                    'fullname' => $fullname,
                    'mobile' => $mobile,
                    'email' => $email,
                    'address' => $address
                ];
                $body = $this->render('views/payments/mail_template_order.php',
                    ['info_customer' => $info_customer]);
                Helper::sendMail($email, $subject, $body, $username, $password);
                //sau khi gửi mail thì xóa giỏ hàng
                unset($_SESSION['cart']);

                //dựa vào phương thức thanh toán mà user chọn để thanh toán
                //nếu là thanh toán trực tuyến
                if ($method == 0) {
                    $_SESSION['nganluong_info'] = [
                        'price_total' => $price_total,
                        'fullname' => $fullname,
                        'email' => $email,
                        'mobile' => $mobile,
                    ];
                    header('Location: thanh-toan-online.html');
                    exit();
                } else {
                    header('Location: cam-on.html');
                    exit();
                }

            }
        }
        //lấy nôi dung view
        $this->content = $this->render('views/payments/index.php');
        require_once 'views/layouts/main.php';
    }

    //phuiongw thức thanh toán online
    public function online()
    {
        //tạo session chưa thông tin tương ứng

        //gọi virews, lưu ý view thanh toán trực tuyến ko liên quan đến trang của bạn
        $view_online = $this->render('libraries/nganluong/index.php');
        echo $view_online;
        //sau khi hiển thị thì xóa session
        unset($_SESSION['nganluong_info']);
    }

    public function thank()
    {
        //xóa thông tin giỏ hàng đi
        unset($_SESSION['cart']);
        $this->content = $this->render('views/payments/thank.php');
        require_once 'views/layouts/main.php';
    }

    public function payment()
    {

        $this->content = $this->render('libraries/nganluong/index.php');

        require_once 'views/layouts/main.php';
    }

}