<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 10/10/2020
 * Time: 4:13 PM
 */
class Heart extends Model {
    public $user_id;
    public $product_id;

    //pt lấy các sản phẩm ưa thích của 1 user
    public function getFavoriteProduct($user_id){
        $sql_select = "SELECT * FROM favorite_products WHERE user_id = $user_id";
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
        $favorite_products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $favorite_products;
    }

    public function getFavoriteAmount($user_id){
        $sql_select = "SELECT COUNT(*) FROM favorite_products WHERE user_id = $user_id";
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
        $favorite_amount = $obj_select->fetch(PDO::FETCH_ASSOC);
        return $favorite_amount;
    }

    //pt insert
    public function add(){

        $sql_insert = "INSERT INTO favorite_products (user_id, product_id) VALUES ( $this->user_id, $this->product_id )";
        $obj_insert = $this->connection->prepare($sql_insert);
        $is_insert = $obj_insert->execute();
        return $is_insert;
    }

    //xóa
    public function delete($user_id, $product_id){
        $sql_delete = "DELETE FROM favorite_products WHERE user_id = $user_id AND product_id = $product_id";
        $obj_delete = $this->connection->prepare($sql_delete);
        $is_delete = $obj_delete->execute();
        return $is_delete;
    }

    //pt kiểm tra sự tồn tại của sản phẩm và user
    public function is_favorite($user_id, $product_id){
        $sql_select = "SELECT * FROM favorite_products WHERE `user_id`=$user_id AND `product_id`=$product_id";
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
        $favorite_products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        echo "<pre>";
        print_r($favorite_products);
        echo "</pre>";
        $is_favorite = True;
        var_dump($sql_select);
        if (empty($favorite_products)){
            $is_favorite = False;
        }
        return $is_favorite;
    }

}
?>