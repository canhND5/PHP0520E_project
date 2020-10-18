<?php
require_once 'models/Model.php';
class Order extends Model {
    public $id;
    public $fullname;
    public $address;
    public $mobile;
    public $email;
    public $note;
    public $price_total;
    public $payment_status;

    public function insert(){
        //pt này sẽ trả về ID của bản ghi vừa insert
        $sql_insert = "INSERT INTO orders(fullname, address, mobile, email, note, price_total, payment_status) 
                      VALUES (:fullname, :address, :mobile, :email, :note, :price_total, :payment_status)";
        //tạo dối tượng truy vấn
        $obj_insert = $this->connection->prepare($sql_insert);
        //tạo mảng truy vấn
        $arr_insert = [
            ':fullname' => $this->fullname,
            ':address' => $this->address,
            ':mobile' => $this->mobile,
            ':email' => $this->email,
            ':note' => $this->note,
            ':price_total' => $this->price_total,
            ':payment_status' => $this->payment_status,
        ];
        //thực thi truy vấn
        $obj_insert->execute($arr_insert);
        $order_id = $this->connection->lastInsertId();
        return $order_id;

    }

}