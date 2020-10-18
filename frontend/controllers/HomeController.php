<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';

class HomeController extends Controller {
  public function index() {
    $product_model = new Product();
    $products = $product_model->getProductInHomePage();

    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/homes/index.php', [
      'products' => $products,
      'categories' => $categories
    ]);
    require_once 'views/layouts/main.php';
  }
}