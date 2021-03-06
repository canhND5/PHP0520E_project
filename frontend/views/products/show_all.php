<!--Chức nwang filter do kết hợp với rewrite url nên ko dùng phương thức GET cho form, vì xử lý rewrite sẽ rất phức tạp
thay vào đó sẽ dùng POST
-->
<?php
require_once 'helpers/Helper.php';
?>
<div class="container">
    <div class="row">
        <div class="main-left col-md-3 col-sm-3 col-xs-12">
            <h3>Lọc</h3>
            <form action="" method="POST">
              <?php if (!empty($categories)): ?>
                  <div class="form-group">
                      <b>Danh mục</b> <br/>
                    <?php foreach ($categories AS $category):
                      //đổ lại dữ liệu đã check category
                      $category_checked = '';
                      if (isset($_POST['category'])) {
                        if (in_array($category['id'], $_POST['category'])) {
                          $category_checked = 'checked';
                        }
                      }
                      ?>
                        <input type="checkbox" name="category[]"
                               value="<?php echo $category['id']; ?>" <?php echo $category_checked; ?> />
                      <?php echo $category['name']; ?>
                        <br/>
                    <?php endforeach; ?>

                  </div>
              <?php endif; ?>

                <div class="form-group">
                    <b>Khoảng giá</b> <br/>
                  <?php
                  //cần đổ lại dữ liệu ra form search
                  $price1_checked = '';
                  $price2_checked = '';
                  $price3_checked = '';
                  $price4_checked = '';
                  if (isset($_POST['price'])) {
                    foreach ($_POST['price'] as $price) {
                      if ($price == 1) {
                        $price1_checked = 'checked';
                      }
                      if ($price == 2) {
                        $price2_checked = 'checked';
                      }
                      if ($price == 3) {
                        $price3_checked = 'checked';
                      }
                      if ($price == 4) {
                        $price4_checked = 'checked';
                      }
                    }
                  }
                  ?>
                    <input type="checkbox" name="price[]" value="1" <?php echo $price1_checked; ?> /> Dưới 1tr <br/>
                    <input type="checkbox" name="price[]" value="2" <?php echo $price2_checked; ?> /> Từ 1 - 2tr
                    <br/>
                    <input type="checkbox" name="price[]" value="3" <?php echo $price3_checked; ?> /> Từ 2 - 3tr
                    <br/>
                    <input type="checkbox" name="price[]" value="4" <?php echo $price4_checked; ?> /> Trên 3tr
                    <br/>
                </div>
                <div class="form-group">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary"/>
                    <a href="danh-sach-san-pham.html" class="btn btn-default">Xóa filter</a>
                </div>
            </form>
        </div>
        <div class="main-right col-md-9 col-sm-9 col-xs-12">
            <h2>Danh sách sản phẩm</h2>
            <div class="row">
                <?php foreach ($products AS $product):
                    $slug = Helper::getSlug($product['title']);
                    $product_link = "san-pham-$slug-" . $product['id'] . ".html";
                    $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                    ?>
                    <div class="col col-md-3">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" title="<?php echo $product['title'] ?>"
                                     src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                     alt="<?php echo $product['title'] ?>"/>
                                <!--                <img class="img-fluid" src="assets/images/product/feature-product/f-p-1.jpg" alt="">-->
                                <div class="p_icon">
                                    <a href="#" class="add-to-heart">
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
    </div>

</div>

