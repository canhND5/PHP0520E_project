<?php
require_once 'controllers/Controller.php';
require_once 'models/Blog.php';
require_once 'models/Pagination.php';

class BlogController extends Controller
{
    public function index()
    {
        //hiển thị danh sách category
        $blogs_model = new Blog();
        //do có sử dụng phân trang nên sẽ khai báo mảng các params
        $params = [
            'limit' => 5, //giới hạn 5 bản ghi 1 trang
            'query_string' => 'page',
            'controller' => 'blog',
            'action' => 'index',
            'full_mode' => FALSE,
        ];
//    mặc đinh page hiện tại là 1
        $page = 1;
        //nếu có truyền tham số page lên trình duyêt - tương đương đang ở tại trang nào, thì gán giá trị đó cho biến $page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        //xử lý form tìm kiếm
//        if (isset($_GET['title'])) {
//            $params['query_additional'] = '&title=' . $_GET['title'];
//        }

        //lấy tổng số bản ghi dựa theo các điều kiện có được từ mảng params truyền vào
        $count_total = $blogs_model->countTotal();
        $params['total'] = $count_total;

        //gán biến name cho mảng params với key là name
        $params['page'] = $page;
        $pagination = new Pagination($params);
        //lấy ra html phân trang
        $pages = $pagination->getPagination();

        //lấy danh sách category sử dụng phân trang
        $blogs = $blogs_model->getAllPagination($params);

        $this->content = $this->render('views/blogs/index.php', [
            //truyền biến $categories ra vew
            'blogs' => $blogs,
            //truyền biến phân trang ra view
            'pages' => $pages,
        ]);

        //gọi layout để nhúng thuộc tính $this->content
        require_once 'views/layouts/main.php';
    }


}