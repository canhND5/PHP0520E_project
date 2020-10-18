<?php
require_once 'models/Model.php';
class User extends Model {
    //khai báo các thuộc tính trong model chính là các trường trong bảng User
    public $id;
    public $username;
    public $password;
    //Phương thức Kiểm tra username đã tồn tại hay chưa
    public function isExistUsername($username){
        //Tạo câu truy vấn:
        $sql_select_one = "SELECT * FROM users WHERE username = :username";
        //tạo đối tượng truy vấn, prepare
        $obj_select_one = $this->connection->prepare($sql_select_one);
        //Tạo mảng để truyền giá trị thật cho tham số trong câu truy vấn
        $arr_select = [
          ':username' => $username
        ];
        //thực thị truy vấn
        $obj_select_one->execute($arr_select);
        //lấy mảng trả về: fetch
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)){
            return TRUE;
        }
        return FALSE;
    }
    //phuongw thức đăng ký user dựa vào username, pass
    public function register($username,$password,$email){
        //tạo câu truy vấn dạng tham số
        $sql_insert = "INSERT INTO users(username, password, email) VALUES (:username, :password, :email)";
        //tạo đối tượng truy vấn
        $obj_insert = $this->connection->prepare($sql_insert);
        // + Tạo mảng để truyền giá trị thật cho tham số của câu truy vấn
        $arr_insert = [
          ':username' => $username,
          ':password' => $password,
          ':email' => $email
        ];
        //thực thi truy vấn
        $is_insert = $obj_insert->execute($arr_insert);
        return $is_insert;
    }

    //phương thức lấy user theo username và pass
    public function getUser($username, $password){
        //tạo casu truy vấn
        $sql_select_one = "SELECT * FROM users WHERE username = :username AND password = :password";
        //tạo đối tượng truy vấn,
        $obj_select_one = $this->connection->prepare($sql_select_one);
        //tạo mảng gán giá trị cho tham số
        $arr_select = [
          ':username' => $username,
          ':password' => $password
        ];
        //thực thi đới tượng truy vấn
        $obj_select_one->execute($arr_select);
        //+ Lấy mảng dữ liệu
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getById($id) {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM users WHERE id = $id");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id) {
        $obj_update = $this->connection
            ->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, phone=:phone, 
            address=:address, email=:email, avatar=:avatar, jobs=:jobs, facebook=:facebook
             WHERE id = $id");
        $arr_update = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':address' => $this->address,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':jobs' => $this->jobs,
            ':facebook' => $this->facebook
//            ':status' => $this->status,
//            ':updated_at' => $this->updated_at,
        ];
        $obj_update->execute($arr_update);

        return $obj_update->execute($arr_update);
    }
}


















