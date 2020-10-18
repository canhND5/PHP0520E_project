<?php
require_once 'models/Model.php';
class OrderDetail extends Model {
    public $order_id;
    public $product_id;
    public $quantity;

    //pt insert
    public function insert(){
        //câu truy vấn
        $sql_insert = "INSERT INTO order_details(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";
        //tạo đối tượng truy vấn
        $obj_insert = $this->connection->prepare($sql_insert);
        //tạo mảng tham số
        $arr_insert = [
          ':order_id' => $this->order_id,
          ':product_id' => $this->product_id,
          ':quantity' => $this->quantity
        ];
        //thực thi truy vấn
        $is_insert = $obj_insert->execute($arr_insert);
        return $is_insert;
    }

}