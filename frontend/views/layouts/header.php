<?php
require_once 'models/Category.php';
$category_model = new Category();
$categories = $category_model->getAll();
?>

<header class="header_area">

    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.php">
                    <img src="assets/images/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="row w-100">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">Shop<i class="fas fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="danh-sach-san-pham.html">Danh sách sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dang-ky-tai-khoan.html">Đăng ký tài khoản</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.html">Product Checkout</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.html">Shopping Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="confirmation.html">Confirmation</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">Blog<i class="fas fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="blog.html">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="single-blog.html">Blog Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">Pages<i class="fas fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.html">Đăng nhập</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dang-ky-tai-khoan.html">Đăng ký</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="tracking.html">Elements</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <hr>

                                <li class="nav-item">
                                    <a href="profile.html" class="icons">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <hr>

                                <li class="nav-item">
                                    <a href="san-pham-ua-thich.html" class="icons">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <hr >

                                <li class="nav-item">
                                    <a href="gio-hang-cua-ban.html" class="icons">
                                        <i class="lnr lnr lnr-cart"></i>
                                        <?php
                                        $cart_total = 0;
                                        if (isset($_SESSION['cart'])) {
                                            foreach ($_SESSION['cart'] AS $cart) {
                                                $cart_total += $cart['quantity'];
                                            }
                                        }
                                        ?>
                                        <span class="cart-amount" style="font-size: 15px;color: blue">
                                        <?php echo isset($_SESSION['cart'])&& isset($cart_total) ? $cart_total : ''; ?>
                                        </span>

                                    </a>
                                </li>
                                <hr>

                                <li class="nav-item">
                                    <?php $confirm = "return confirm('bạn muốn đăng xuất đúng ko?')" ?>
                                    <a onclick="<?php echo isset($_SESSION['user']) ? $confirm : '' ?>" href="<?php echo isset($_SESSION['user']) ? 'logout.html' : 'login.html'?>" class="icons">
                                        <i class="lnr lnr lnr-enter"></i> /
                                        <i class="lnr lnr lnr-exit"></i>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </nav>
        <div class="container-fluid row">

            <div class="col-md-9 col-sm-12 col-12 row">
                <?php foreach ($categories AS $category) : ?>
                <div class="category_item col-md-2 col-sm-4 col-4">
                    <a style="display: inline-block;width: 100%" href="danh-mục-<?php echo $category['name'];?>-<?php echo $category['id'];?>.html">
                        <?php echo $category['name'];?>
                    </a>
                </div>
                <?php endforeach; ?>
<!--                <div class="category_item col-md-2"> <a href="#">Laptop</a></div>-->
<!--                <div class="category_item col-md-2"> <a href="#">Tablet</a></div>-->
<!--                <div class="category_item col-md-2"> <a href="#">Phụ kiện</a></div>-->
<!--                <div class="category_item col-md-2"> <a href="#">Đồng hồ thời trang</a></div>-->
<!--                <div class="category_item col-md-2"> <a href="#">Đồng hồ thông minh</a></div>-->
            </div>
            <div class="col-md-3 col-sm-12 col-12 row">
                <form >
                    <input class=" col-md-8" type="text" name="" value="" placeholder="Search">
<!--                    <div class="category_item col-md-4">-->
                    <button class="btn-primary">
                        <i class="fa fa-search" aria-hidden="true"></i> Search
                    </button>
<!--                        <a href="#" class="">-->
<!--                           -->
<!--                        </a>-->
<!--                    </div>-->
                </form>
            </div>
        </div>
    </div>





</header>
<span class="ajax-message">Thêm vào giỏ thành công</span>


