<?php
require_once 'helpers/Helper.php';
?>
<!--    END PRODUCT-->

<div class="container-fluid">
    <!--        <div class="row">-->
    <!--            <div class="main_title">-->
    <!--                <h2>Một số hãng nổi tiếng</h2>-->
    <!--                <h2>Một số hãng nổi tiếng</h2>-->
    <!--                <!--                <p>Who are in extremely love with eco friendly system.</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <div class="row hang_dt">
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/iphone 1.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/samsung.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/oppo.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/realme.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/vivo.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/xiaomi.png" alt="">
        </div>
        <!--            //-->
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/iphone 1.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/samsung.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/oppo.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/realme.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/vivo.png" alt="">
        </div>
        <div class="logo_item col-md-1 col-2">
            <img class="clients_logo_img" src="assets/images/clients-logo/xiaomi.png" alt="">
        </div>
    </div>

</div>
<!--================Hot Deals Area =================-->
<section class="hot_deals_area section_gap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="hot_deal_box">
                    <img class="img-fluid" src="assets/images/product/hot_deals/deal1.jpg" alt="">
                    <div class="content">
                        <h2>Trung Thu/Khuyến mãi cực sốc</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hot_deal_box">
                    <img class="img-fluid" src="assets/images/product/hot_deals/deal1.jpg" alt="">
                    <div class="content">
                        <h2>Hot Deals of this Month</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Hot Deals Area =================-->



<!--================Feature Product Area =================-->
<section class="feature_product_area section_gap">
    <div class="main_box">
        <div class="container-fluid">


            <div class="row">
                <div class="main_title">
                        <h2 >
                            <a href="danh-sach-san-pham.html">Sản phẩm mới </a>
                        </h2>
                </div>
            </div>
            <div class="row">
                <?php foreach ($products AS $product):
                    $slug = Helper::getSlug($product['title']);
                    $product_link = "san-pham-$slug-" . $product['id'] . ".html";
                    $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                    ?>
                    <div class="col col-md-2">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" title="<?php echo $product['title'] ?>"
                                     src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                     alt="<?php echo $product['title'] ?>"/>
                                <!--                <img class="img-fluid" src="assets/images/product/feature-product/f-p-1.jpg" alt="">-->
                                <div class="p_icon">
                                    <a href="<?php echo !isset($_SESSION['user']) ? 'index.php?controller=heart&action=add' : '#';?> "
                                       class="<?php echo isset($_SESSION['user']) ? 'add-to-heart' : 'add-to-heart1';?> " data-id="<?php echo $product['id']?>">
                                        <i class="lnr lnr-heart"></i>
                                    </a>
                                    <a href="#" class="add-to-cart" data-id="<?php echo $product['id']?>">
                                        <i class="lnr lnr-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product_detail_link">
                                <a class="" href="<?php echo $product_link; ?>">
                                    <h4><?php echo $product['title'] ?></h4>
                                </a>
                            </div>

                            <h5><?php echo number_format($product['price']) ?> đ</h5>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>

        <div class="row">
            <nav class="cat_page mx-auto" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">01</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">02</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">03</a>
                    </li>
                    <li class="page-item blank">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">09</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </div>
</section>
<!--================End Feature Product Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="main_title">
            <h2>Blog</h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="assets/images/blog/cat-post/cat-post-3.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Social Life</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Enjoy your social life together</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="assets/images/blog/cat-post/cat-post-2.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Politics</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Be a part of politics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="assets/images/blog/cat-post/cat-post-1.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Food</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Let the food be finished</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--================ Subscription Area ================-->
<section class="subscription-area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2>Subscribe for Our Newsletter</h2>
                    <span>We won’t send any kind of spam</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div id="mc_embed_signup">
                    <form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01"
                          method="get" class="subscription relative">
                        <input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"
                               required="">
                        <!-- <div style="position: absolute; left: -5000px;">
                            <input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
                        </div> -->
                        <button type="submit" class="newsl-btn">Get Started</button>
                        <div class="info"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Subscription Area ================-->
<!--NEWS-->
<!--<div class="news-wrap">-->
<!--    <div class="news container">-->
<!--        <h1 class="post-list-title">-->
<!--            <a href="/news.html" class="link-category-item">Tin mới nhất</a>-->
<!--        </h1>-->
<!--        <div class="row">-->
<!--            <div class="col-md-4 col-sm-4 col-xs-12 category-two-item">-->
<!--                <a href="news_detail.html" class="two-item-link-heading">-->
<!--                    <span class="new-image-content">-->
<!--                        <img src="assets/images/news.jpg"-->
<!--                             title="BÍ MẬT SƠN TINH CAMP"-->
<!--                             alt="BÍ MẬT SƠN TINH CAMP"-->
<!--                             class="post-image-avatar img-responsive">-->
<!--                    </span>-->
<!--                </a>-->
<!--                <div class="news-content-wrap">-->
<!--                    <h3 class="category-heading timeline-post-title">-->
<!--                        <a href="#">-->
<!--                            BÍ MẬT SƠN TINH CAMP </a>-->
<!--                    </h3>-->
<!--                    <div class="news-description">-->
<!--                        Hàng trăm năm qua, không ít những câu chuyện truyền tai nhau sản sinh ra nơi hòn đảo Sơn-->
<!--                        Tinh xinh đẹp. Họ không cùng màu da, không cùng tôn giáo, họ đến từ nhiều nơi và họ là-->
<!--                        những-->
<!--                        con người sôi nổi, thích phiêu lưu. Có phải vì những lời kể ấy đã lôi cuốn họ tìm đến-->
<!--                        Sơn-->
<!--                        Tinh, hay chính vì sự hoang dã tuyệt đẹp của không gian, bởi sự trù phú của sản-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4 col-sm-4 col-xs-12 category-two-item">-->
<!--                <a href="news_detail.html" class="two-item-link-heading">-->
<!--                    <span class="new-image-content">-->
<!--                        <img src="assets/images/news.jpg"-->
<!--                             title="BÍ MẬT SƠN TINH CAMP"-->
<!--                             alt="BÍ MẬT SƠN TINH CAMP"-->
<!--                             class="post-image-avatar img-responsive">-->
<!--                    </span>-->
<!--                </a>-->
<!--                <div class="news-content-wrap">-->
<!--                    <h3 class="category-heading timeline-post-title">-->
<!--                        <a href="#">-->
<!--                            BÍ MẬT SƠN TINH CAMP </a>-->
<!--                    </h3>-->
<!--                    <div class="news-description">-->
<!--                        Hàng trăm năm qua, không ít những câu chuyện truyền tai nhau sản sinh ra nơi hòn đảo Sơn-->
<!--                        Tinh xinh đẹp. Họ không cùng màu da, không cùng tôn giáo, họ đến từ nhiều nơi và họ là-->
<!--                        những-->
<!--                        con người sôi nổi, thích phiêu lưu. Có phải vì những lời kể ấy đã lôi cuốn họ tìm đến-->
<!--                        Sơn-->
<!--                        Tinh, hay chính vì sự hoang dã tuyệt đẹp của không gian, bởi sự trù phú của sản-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--END NEWS-->