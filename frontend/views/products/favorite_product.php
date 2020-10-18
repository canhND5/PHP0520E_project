<?php
///**
// * Created by PhpStorm.
// * User: KyThuat88
// * Date: 10/11/2020
// * Time: 9:29 AM
// */
//echo "favorite product";
//?>
<!--<div class="container-fluid">-->
<!--    <h2>Danh sách sản phẩm yêu thích của bạn</h2>-->
<!--    <table class="table">-->
<!--        <tr>-->
<!--            <th>avatar sản phẩm</th>-->
<!--            <th>Tên sản phẩm</th>-->
<!--            <th>Mô tả sản phẩm</th>-->
<!--            <th>Giá sản phẩm</th>-->
<!--            <th></th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>avatar sản phẩm</td>-->
<!--            <td>Tên sản phẩm</td>-->
<!--            <td>Mô tả sản phẩm</td>-->
<!--            <td>Giá sản phẩm</td>-->
<!--            <td>chọn số lượng<a href="#">Thêm vào giỏ hàng</a></td>-->
<!--            <td>Xóa</td>-->
<!--        </tr>-->
<!--    </table>-->
<!--</div>-->
<?php
require_once 'helpers/Helper.php';
require_once 'models/Product.php';
?>

<?php if (isset($_SESSION['user'])) : ?>

<?php
//echo "<pre>";
//print_r($_POST);
//print_r($_SESSION['cart']);
//echo "</pre>";

?>
<style>
    td:last-child,th:last-child{
        text-align: right;
    }
</style>
<form action="" method="post">
    <section class="cart_area">
        <div class="container-fluid">

            <h2>
                <i class="lnr lnr lnr-heart"></i> Sản phẩm ưa thích của bản
            </h2>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_cart = 0;
                        foreach ($favorite_products as $favorite_product) :
                            $model_product = new Product();
                            $product_id = $favorite_product['product_id'];
                            $product = $model_product->getById($product_id);

                            ?>

                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>
                                                <?php
                                                //Khai báo link rewrite cho trang chi tiết sản phẩm
                                                $slug = Helper::getSlug($product['title']);
                                                $product_link = "san-pham-$slug-$product_id.html";
                                                ?>
                                                <a href="<?php echo $product_link; ?>"
                                                   class="content-product-a">
                                                    <?php echo $product['title']; ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?php echo number_format($product['price']); ?> VND</h5>
                                </td>

                                <td>
                                    <h5><?php echo number_format($product['amount']); ?></h5>
                                </td>

                                <td>
                                    <div class="checkout_btn_inner">
                                        <a class=" add-to-cart main_btn" data-id="<?php echo $product_id;?>"
                                           href="#">Thêm vào giỏ hàng</a>
                                    </div>
                                </td>
                                <td>
                                    <a href="xoa-san-pham-ua-thich/<?php echo $product_id?>.html"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                            <td colspan="4">
                                <div class="checkout_btn_inner">
                                    <a class="gray_btn" href="index.php">Continue Shopping</a>
<!--                                    <a class="main_btn" href="thanh-toan.html">Proceed to checkout</a>-->
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
                <div class="container-fluid">
                    <h2 style="text-align: center">Chưa đăng nhập nên không có thông tin sản phẩm ưa thích của mình</h2>
                    <div style="text-align: center">
                        <a class="main_btn" href="index.php">QUAY LẠI MUA HÀNG</a>
                        <a class="main_btn " href="login.html">ĐĂNG NHẬP</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</form>

