<?php
//models/Category
require_once 'models/Model.php';
class Blog extends Model {
    //khai báo các thuộc tính cho model trùng với các trường
//    của bảng categories
    public $id;
    public $category_id;
    public $title;
    public $summary;
    public $avatar;
    public $content;
    public $status;
    public $created_at;
    public $updated_at;

    //insert dữ liệu vào bảng categories
    public function insert() {
        $sql_insert =
            "INSERT INTO blogs(`category_id`, `title`, `summary`, `avatar`, `content`, `status`)
VALUES (:category_id, :title, :summary, :avatar, :content, :status)";
        //cbi đối tượng truy vấn
        $obj_insert = $this->connection
            ->prepare($sql_insert);
        //gán giá trị thật cho các placeholder
        $arr_insert = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':content' => $this->content,
            ':status' => $this->status
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * LẤy thông tin danh mục trên hệ thống
     * @param $params array Mảng các tham số search
     * @return array
     */
    public function getAll($params = []) {
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        //tạo 1 chuỗi truy vấn để thêm các điều kiện search
        //dựa vào mảng params truyền vào
        $str_search = 'WHERE TRUE';
        //check mảng param truyền vào để thay đổi lại chuỗi search
        if (isset($params['title']) && !empty($params['title'])) {
            $title = $params['title'];
            //nhớ phải có dấu cách ở đầu chuỗi
            $str_search .= " AND `title` LIKE '%$title%'";
        }
        if (isset($params['status'])) {
            $status = $params['status'];
            $str_search .= " AND `status` = $status";
        }
        //tạo câu truy vấn
        //gắn chuỗi search nếu có vào truy vấn ban đầu
        $sql_select_all = "SELECT * FROM blogs $str_search";
        //cbi đối tượng truy vấn
        $obj_select_all = $this->connection
            ->prepare($sql_select_all);
        $obj_select_all->execute();
        $blogs = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $blogs;
    }

    public function getById($id) {
        $sql_select_one = "SELECT * FROM blogs WHERE id = $id";
        $obj_select_one = $this->connection
            ->prepare($sql_select_one);
        $obj_select_one->execute();
        $blog = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $blog;
    }

    /**
     * Lấy category theo id truyền vào
     * @param $id
     * @return array
     */
    public function getCategoryById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM blogs WHERE id = $id");
        $obj_select->execute();
        $category = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    /**
     * Update bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function update($id)
    {
        $obj_update = $this->connection->prepare(
            "UPDATE blogs SET `category_id` = :category_id, `title` = :title, `avatar` = :avatar, `content` = :content,
                    `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
        $arr_update = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':content' => $this->content,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        return $obj_update->execute($arr_update);
    }

    /**
     * Xóa bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM blogs WHERE id = $id");
        $is_delete = $obj_delete->execute();
        //để đảm bảo toàn vẹn dữ liệu, sau khi xóa category thì cần xóa cả các product nào đang thuộc về category này
        $obj_delete_product = $this->connection
            ->prepare("DELETE FROM products WHERE category_id = $id");
        $obj_delete_product->execute();

        return $is_delete;
    }

    /**
     * Lấy tổng số bản ghi trong bảng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM blogs");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM blogs LIMIT $start, $limit");

//    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
//        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
//        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $blogs = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $blogs;
    }
}