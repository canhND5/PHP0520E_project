<?php
require_once 'helpers/Helper.php';
?>
<!--    END PRODUCT-->
<div class="container-fluid row">
    <div class="col-md-3 col-sm-12 col-12">
        <!--            Phần lọc-->
        <!--            nếu dùng rewrite url thì nên để method là post-->
        <form action="" method="post">
            <h3>Filter</h3>

            <div class="checkbox-price">
                <h5>Lọc theo khoảng giá</h5>
                <?php
                $checked1 = '';
                $checked2 = '';
                $checked3 = '';
                $checked4 = '';

                if (isset($_POST['prices'])) {
                    if (in_array(0, $_POST['prices'])) {
                        $checked1 = 'checked';
                    }
                }
                if (isset($_POST['prices'])) {
                    if (in_array(1, $_POST['prices'])) {
                        $checked2 = 'checked';
                    }
                }
                if (isset($_POST['prices'])) {
                    if (in_array(2, $_POST['prices'])) {
                        $checked3 = 'checked';
                    }
                }
                if (isset($_POST['prices'])) {
                    if (in_array(3, $_POST['prices'])) {
                        $checked4 = 'checked';
                    }
                }
                ?>
                <input type="checkbox" name="prices[]" value="0" <?php echo $checked1 ?>> Nhỏ hơn 1tr <br>
                <input type="checkbox" name="prices[]" value="1" <?php echo $checked2 ?>> Từ 1 đến 2tr<br>
                <input type="checkbox" name="prices[]" value="2" <?php echo $checked3 ?>> Từ 2 đến 3tr<br>
                <input type="checkbox" name="prices[]" value="3" <?php echo $checked4 ?>> Lớn 3tr<br>
            </div>
            <input type="submit" name="filter" value="Tìm kiếm" class="btn btn-primary">
            <a href="danh-sach-san-pham.html" class="btn btn-default">Reset</a>
        </form>

    </div>
    <div class="col-md-9 col-sm-9 col-12 row">
        <?php if (!empty($products)) : ?>

        <?php foreach ($products AS $product):
            $slug = Helper::getSlug($product['title']);
            $product_link = "san-pham-$slug-" . $product['id'] . ".html";
            $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
            ?>
            <div class="col-md-3 col-sm-3 col-6">
                <div class="f_p_item">
                    <div class="f_p_img">
                        <img class="img-fluid" title="<?php echo $product['title'] ?>"
                             src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                             alt="<?php echo $product['title'] ?>"/>
                        <!--                <img class="img-fluid" src="assets/images/product/feature-product/f-p-1.jpg" alt="">-->
                        <div class="p_icon">

                            <a href="index.php?controller=heart&action=add" class="add-to-heart1">
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
        <?php else: ?>
        <h2> Không có sản phẩn nào thỏa mãn điều kiện của bạn</h2>
        <?php endif;?>
    </div>

</div>
