<?php
require_once 'controllers/Controller.php';
require_once 'models/Heart.php';

class HeartController extends Controller{

    public function index(){
        $model_heart = new Heart();
        $favorite_products = $model_heart->getFavoriteProduct($_SESSION['user']['id']);


        //láy views
        $this->content = $this->render('views/products/favorite_product.php',[
            'favorite_products' => $favorite_products
        ]);
        require_once 'views/layouts/main.php';
    }
    public function add(){
        if (!isset($_SESSION['user'])){
            $_SESSION['success'] = 'Bạn cần đăng nhập để có thể thêm vào danh sách ưa thích';
            header('Location: login.html');
            exit();
        }

    }

    public function add1(){
            $model_heart = new Heart();
            $model_heart->user_id = $_SESSION['user']['id'];
            $user_id = $_SESSION['user']['id'];
            $product_id = $_GET['product_id'];
            $model_heart->product_id = $_GET['product_id'];
            $is_favorite = $model_heart->is_favorite($user_id,$product_id);
//            echo "<pre>";
//            print_r($is_favorite);
//            echo "</pre>";
            echo $product_id;
            var_dump($is_favorite) ;
            //nếu ko phải sản phẩm ưa thích thì mới thêm vào
            if($is_favorite==False){
                $is_add = $model_heart->add();
                var_dump($is_add);
            }



//            $is_add = $model_heart->add();
    }

    //xóa san phẩm ưa thích
    public function delete(){
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Không tồn tại id';
            //sau khi xử lý xong giỏ hàng thì chuyển hướng về trang danh sách giỏ hàng
            //do đang sử dụng rewwrite url nên các url khi chuyển hướng cần có cả đường dẫn ứng dụng
//      $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban.html';
            header("Location: ..\san-pham-ua-thich.html");
            exit();
        }
        $user_id = $_SESSION['user']['id'];
        $product_id = $_GET['id'];
        $model_heart = new Heart();
        $is_delete = $model_heart->delete($user_id, $product_id);
        if ($is_delete){
            $_SESSION['success'] = 'Xóa sản phẩm khỏi danh sách ưa thích thành công';
            header("Location: ..\san-pham-ua-thich.html");
            exit();
        }

    }
}
?>