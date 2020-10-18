<?php require_once 'helpers/Helper.php'; ?>

<?php if (isset($_SESSION['cart'])) : ?>

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
                    <i class="lnr lnr lnr-cart"></i> Giỏ hàng của bạn
                </h2>
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total_cart = 0;
                            foreach ($_SESSION['cart'] as $product_id => $cart) :?>

                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="../backend/assets/uploads/<?php echo $cart['avatar'] ?>" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>
                                                    <?php
                                                    //Khai báo link rewrite cho trang chi tiết sản phẩm
                                                    $slug = Helper::getSlug($cart['name']);
                                                    $product_link = "chi-tiet-san-pham/$slug/$product_id";
                                                    ?>
                                                    <a href="<?php echo $product_link; ?>"
                                                       class="content-product-a">
                                                        <?php echo $cart['name']; ?>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5><?php echo number_format($cart['price']); ?> VND</h5>
                                    </td>

                                    <td>
                                        <div class="product_count">

                                            <input type="number" name="<?php echo $product_id; ?>" id="sst"
                                                   min="1" maxlength="12" value="<?php echo $cart['quantity']; ?>" title="Quantity:" class="input-text qty">
                                            <!--                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">-->
                                            <!--                                            <i class="lnr lnr-chevron-up"></i>-->
                                            <!--                                        </button>-->
                                            <!--                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">-->
                                            <!--                                            <i class="lnr lnr-chevron-down"></i>-->
                                            <!--                                        </button>-->
                                        </div>
                                    </td>

                                    <td>
                                        <h5><?php
                                            $total_item = $cart['quantity'] * $cart['price'];
                                            //Cộng tích lũy thành tiền này cho tổng giá trị
                                            //đơn hàng
                                            $total_cart += $total_item;
                                            echo number_format($total_item);
                                            ?> VND</h5>
                                    </td>
                                    <td>
                                        <a href="xoa-san-pham/<?php echo $product_id?>.html"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>

                                </td>
                                <td>
                                    <button class=" main_btn " type="submit" name="update_cart" value="Update Cart">UPDATE CART</button>
<!--                                    <a class="btn gray_btn" href="#">Update Cart</a>-->
                                </td>
                                <td>
                                    <h5>Tổng giá trị đơn hàng</h5>
                                </td>
                                <td>
                                    <h5><?php echo number_format($total_cart);?> VND</h5>
                                </td>
                            </tr>
                            <tr class="bottom_button">

                                <td colspan="2"  style="text-align: right">
                                    <div class="cupon_text">
                                        <input type="text" name="coupon" placeholder="Coupon Code">
                                        <a class="main_btn" href="#">Apply</a>

                                        <!--                                    <a class="gray_btn" href="#">Close Coupon</a>-->
                                    </div>
                                </td>
                                <td>
                                    <h5>Số tiền cần trả</h5>
                                </td>
                                <td>
                                    <h5><?php echo number_format($total_cart);?> VND</h5>
                                </td>
                            </tr>

                            <tr class="out_button_area">

                                <td colspan="4">
                                    <div class="checkout_btn_inner">
                                        <a class="gray_btn" href="index.php">Continue Shopping</a>
                                        <a class="main_btn" href="thanh-toan.html">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
            <div class="container-fluid">
                <h2 style="text-align: center">Bạn không có sản phẩm nào trong giỏ hàng</h2>
                <div style="text-align: center"><a class="btn btn-primary" href="index.php">Return Shopping</a></div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</form>
