<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class ProductController extends Controller {
  public function showAll1() {
//    echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
//    print_r($_REQUEST);
//    echo "</pre>";
//    die;
    $params = [];
    //nếu user có hành động filter
    if (isset($_POST['filter'])) {
      if (isset($_POST['category'])) {
        $category = implode(',', $_POST['category']);
        //chuyển thành chuỗi sau để sử dụng câu lệnh in_array
        $str_category_id = "($category)";
        $params['category'] = $str_category_id;
      }
      if (isset($_POST['price'])) {
        $str_price = '';
        foreach ($_POST['price'] AS $price) {
          if ($price == 0) {
            $str_price .= " OR products.price < 1000000";
          }
          if ($price == 1) {
            $str_price .= " OR (products.price >= 1000000 AND products.price < 20000000)";
          }
          if ($price == 2) {
            $str_price .= " OR (products.price >= 2000000 AND products.price < 30000000)";
          }
          if ($price == 3) {
            $str_price .= " OR products.price >= 3000000";
          }
        }
        //cắt bỏ từ khóa OR ở vị trí ban đầu
        $str_price = substr($str_price, 3);
        $str_price = "($str_price)";
        $params['price'] = $str_price;
      }
    }

    $params_pagination = [
      'total' => 5,
      'limit' => 1,
      'full_mode' => FALSE,
    ];
    //xử lý phân trang
//    $pagination_model = new Pagination($params_pagination);
//    $pagination = $pagination_model->getPagination();
    //get products
    $product_model = new Product();
    $products = $product_model->getProductInHomePage($params);

    //get categories để filter
    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/products/show_all.php', [
      'products' => $products,
      'categories' => $categories,
//      'pagination' => $pagination,
    ]);

    require_once 'views/layouts/main.php';
  }

    public function showAll(){
//      echo "<pre>";
//      print_r($_POST);
//      echo "</pre>";
        //tạo mảng chứa tham số liên quan tới filter
        $params = [];
        if (isset($_POST['filter'])){
            //khai báo 2 chuỗi chuawscaau truy vấn cho category_id
            $query_category_id = '';
            $query_price = '';

            //xử lý tạo câu truy vấn category_id
            if (isset($_POST['categories'])){ //nếu user tích chọn thì danh mục thì mới xử lý
                //câu truy vấn cần có dạng sau: OR category_id = 1 OR category_id = 2..., hay dùng từ khóa IN(1, 2, 3)
                $categories = $_POST['categories'];
                $categories_id_str = implode(',', $categories);
//              var_dump($categories_id_str);
                $query_category_id = " AND (products.category_id IN ($categories_id_str))";
            }
            //xử lý tạo câu truy vấn cho khoảng giá
            if (isset($_POST['prices'])){ //nếu user chọn mới có
                $prices = $_POST['prices'];
                foreach ($prices AS $price){
                    switch ($price){
                        case 0: //khoảng giá từ 0 - 1tr
                            $query_price .= " OR (products.price BETWEEN 0 AND 1000000)";
                            break;
                        case 1: //khoảng giá từ 1 - 2tr
                            $query_price .= " OR (products.price BETWEEN 1000000 AND 2000000)";
                            break;
                        case 2: //khoảng giá từ 2 - 3tr
                            $query_price .= " OR (products.price BETWEEN 2000000 AND 3000000)";
                            break;
                        default: //khoảng > 3tr
                            $query_price .= " OR (products.price > 3000000)";
                    }
                }

                //xử lý cắt bỏ chuỗi OR ở đầu, dùng hàm substr()
                $query_price = substr($query_price,4);//lấy từ vị trí thứ 3 trở đi

                //gán lại, thêm từ khóa AND
                $query_price = " AND ($query_price)";
                var_dump($query_price);
            }
            $params['query_category_id'] = $query_category_id;
            $params['query_price'] = $query_price;

        }


        //lấy ra danh sách toàn bộ sản phẩn trên hệ thống
        $product_model = new Product();
        $products = $product_model->getAllFilter($params);
        //lấy ra toàn bộ danh mục đang có để hiển thị
        $category_model = new Category();
        $categories = $category_model->getAll();

        //Gọi views
        $this->content = $this->render('views/products/filter.php',[
            'products' => $products,
            'categories' => $categories
        ]);
        require_once 'views/layouts/main.php';
    }

  public function detail() {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID ko hợp lệ';
      $url_redirect = $_SERVER['SCRIPT_NAME'] . '/';
      header("Location: $url_redirect");
      exit();
    }

    $id = $_GET['id'];
    $product_model = new Product();
    $product = $product_model->getById($id);
    $product_relatives = $product_model->get4ByCategory($product['category_id']);

    $this->content = $this->render('views/products/detail1.php', [
      'product' => $product,
      'product_relatives' => $product_relatives
    ]);
    require_once 'views/layouts/main.php';
  }

  public function detail1(){
      $id = $_GET['id'];

      $product_model = new Product();
      $product = $product_model->getById($id);
      $this->content = $this->render('views/products/detail.php', [
          'product' => $product
      ]);
      require_once 'views/layouts/main.php';
  }

  public function getAllByCategory(){
      $query_price = '';
      if (isset($_POST['filter'])){
          //khai báo  chuỗi chuawscaau truy vấn cho category_id
          //xử lý tạo câu truy vấn cho khoảng giá
          if (isset($_POST['prices'])){ //nếu user chọn mới có
              $prices = $_POST['prices'];
              foreach ($prices AS $price){
                  switch ($price){
                      case 0: //khoảng giá từ 0 - 1tr
                          $query_price .= " OR (products.price BETWEEN 0 AND 1000000)";
                          break;
                      case 1: //khoảng giá từ 1 - 2tr
                          $query_price .= " OR (products.price BETWEEN 1000000 AND 2000000)";
                          break;
                      case 2: //khoảng giá từ 2 - 3tr
                          $query_price .= " OR (products.price BETWEEN 2000000 AND 3000000)";
                          break;
                      default: //khoảng > 3tr
                          $query_price .= " OR (products.price > 3000000)";
                  }
              }

              //xử lý cắt bỏ chuỗi OR ở đầu, dùng hàm substr()
              $query_price = substr($query_price,4);//lấy từ vị trí thứ 3 trở đi

              //gán lại, thêm từ khóa AND
              $query_price = " AND ($query_price)";
//              var_dump($query_price);
          }

      }
      $category_id = $_GET['id'];
      $product_model = new Product();
      $products = $product_model->getAllByCategory($category_id,$query_price);

      $category_model = new Category();
      $categories = $category_model->getAll();

      //lấy views
      $this->content = $this->render('views/products/getAllByCategory.php',[
          'products' => $products,
          'categories' => $categories,
      ]);
      require_once 'views/layouts/main.php';

  }
}