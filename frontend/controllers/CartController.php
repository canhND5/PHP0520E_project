<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller
{

//phương thức thêm SP vào giỏ hàng
  public function add(){
     //debug biến $_GET
//      echo "<pre>";
//      print_r($_GET);
//      echo "</pre>";
      $product_id = $_GET['product_id'];
      //gọi model để lấy ra thông tin của SP theo id trên
      $product_model = new Product();
      $product = $product_model->getById($product_id);
//      echo "<pre>";
//      print_r($product);
//      echo "</pre>";
      //tạo biến để lưu các thông tin SP theo giỏ hàng, tên, giá quantity, avatar
      $cart = [
          'name' => $product['title'],
          'price' => $product['price'],
          'avatar' => $product['avatar'],
          'quantity' => 1 //mặc đjnh =1
      ];
      //khi clikc thêm vào giỏ hàng sẽ có 2 trường hợp xảy ra,
      //nếu Sp chưa có trong giỏ hàng thì cần khỏi tạo giỏ hàng và thêm SP
      if (!isset($_SESSION['cart'])){
          $_SESSION['cart'][$product_id] = $cart;
      }
      //nếu giỏ hàng đã tồn tại sanr phẩm
      // + nếu SP đã tồn tại trong giỏ hàng thì chỉ update số lượng SP đó
      // + nếu Sp chưa có thì thêm mới
      else{
          if (array_key_exists($product_id, $_SESSION['cart'])){
              $_SESSION['cart'][$product_id]['quantity']++;
          }else{
              $_SESSION['cart'][$product_id] = $cart;
          }
      }
      echo "<pre>";
      print_r($_SESSION['cart']);
      echo "</pre>";
  }

    public function index()
    {
        $category_model = new Category();
        $categories = $category_model->getAll();

        // Xử lý Cập nhật giỏ hàngs
        if (isset($_POST['update_cart'])) {
            //Xử lý thêm trường hợp nếu nhập số lượng là số âm thì sẽ
            //ko xủ lý update
            foreach ($_SESSION['cart'] AS $product_id => $cart) {
                if ($_POST[$product_id] < 0) {
                    $_SESSION['error'] = 'Số lượng phải > 0';
                    header('Location: index.php');
                    exit();
                }
            }
            //Lặp giỏ hàng, truy cập phần tử mảng theo id, r set
            //lại số lượng tương ứng từ form gửi lên
            foreach ($_SESSION['cart'] AS $product_id => $cart) {
                $_SESSION['cart'][$product_id]['quantity'] = $_POST[$product_id];
            }
            $_SESSION['success'] = 'Cập nhật giỏ thành công';
        }

        //Lấy  nội dung view views/carts/index.php
        $this->content = $this->render('views/carts/index.php',[
//            'categories' => $categories
            ]);
        // Gọi layout để hiển thị nội dung view trên
        require_once 'views/layouts/main.php';

    }

  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Không tồn tại id';
      //sau khi xử lý xong giỏ hàng thì chuyển hướng về trang danh sách giỏ hàng
      //do đang sử dụng rewwrite url nên các url khi chuyển hướng cần có cả đường dẫn ứng dụng
//      $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban.html';
      header("Location: gio-hang-cua-ban.html");
      exit();
    }

    $product_id = $_GET['id'];
    unset($_SESSION['cart'][$product_id]);
    //nếu sau khi xóa sản phẩm hiện tại, nếu giỏ hàng trống thì xóa session cart này đi
    if (empty($_SESSION['cart'])) {
      unset($_SESSION['cart']);
    }

    $_SESSION['success'] = 'Xóa sản phẩm khỏi giỏ hàng thành công';

    //chuyển hướng về trang giỏ hàng
    //sau khi xử lý xong giỏ hàng thì chuyển hướng về trang danh sách giỏ hàng
    //do đang sử dụng rewwrite url nên các url khi chuyển hướng cần có cả đường dẫn ứng dụng
//    $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban.html';
    header("Location: ..\gio-hang-cua-ban.html");
    exit();
  }
}