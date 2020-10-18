<?php
require_once 'models/Model.php';
class Product extends Model {

  public function getProductInHomePage($params = []) {
    $str_filter = '';
    if (isset($params['category'])) {
      $str_category = $params['category'];
      $str_filter .= " AND categories.id IN $str_category";
    }
    if (isset($params['price'])) {
      $str_price = $params['price'];
      $str_filter .= " AND $str_price";
    }
    //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
    $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 $str_filter";

    $obj_select = $this->connection->prepare($sql_select);
    $obj_select->execute();

    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }

  /**
   * Lấy thông tin sản phẩm theo id
   * @param $id
   * @return mixed
   */
  public function getById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

    $obj_select->execute();
    $product =  $obj_select->fetch(PDO::FETCH_ASSOC);
    return $product;
  }

  //update sơ lượng còn lại sản phẩm sau khi bán dươc
    public function updateAmount($id, $amount){
      $sql_update = "UPDATE products SET amount = $amount WHERE id = $id";
      $obj_update = $this->connection->prepare($sql_update);
      $is_update = $obj_update->execute();
      return $is_update;
    }

  public function get4ByCategory($category_id){
      $obj_select = $this->connection->prepare(
          "SELECT * FROM products WHERE category_id = $category_id LIMIT 0,4");

      $obj_select->execute();
      $products =  $obj_select->fetchAll(PDO::FETCH_ASSOC);
      return $products;
  }

    public function getAllByCategory($category_id,$query_price){
        $obj_select = $this->connection->prepare(
            "SELECT * FROM products WHERE category_id = $category_id AND status = 1 $query_price");

        $obj_select->execute();
        $products =  $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getAllFilter($params = []){
//      echo "<pre>";
//      print_r($params);
//      echo "</pre>";
        //luôn phải kiểm tra mảng tồn tại theo key
        $query_category_id = '';
        if (isset($params['query_category_id'])){
            $query_category_id = $params['query_category_id'];
        }
        $query_price = '';
        if (isset($params['query_price'])){
            $query_price = $params['query_price'];
        }
        //tạo truy vấn
        $sql_select_all = "SELECT products.*, categories.name AS category_name FROM products 
                    INNER JOIN categories ON products.category_id = categories.id WHERE products.status = 1 $query_category_id $query_price";
        //tạo đối tượng truy vấn
        $obj_select_all = $this->connection->prepare($sql_select_all);
        //thực thi truy vấn
        $obj_select_all->execute();
        //lấy ra mảng product
        $products = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

}

