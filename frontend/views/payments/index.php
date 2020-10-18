<?php
require_once 'helpers/Helper.php';
?>
<div class="container">
    <?php if (!isset($_SESSION['user'])) : ?>
        <div class="returning_customer">
            <div class="check_title">
                <h2>Returning Customer?
                    <a href="#">Click here to login</a>
                </h2>
            </div>
            <p>Nếu bạn đã có tài khoản thì vui lòng đăng nhập ở đây để có thể điền vào
                bảng thông tin phía dưới đây nhanh hơn, Nếu không bạn có thể đăng ký tài khoản hoặc điền trực tiếp vào mẫu phía dưới</p>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" id="name" name="username" value=" ">
                    <span class="placeholder" data-placeholder="Username or Email"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                    <input type="password" class="form-control" id="password" name="password" value="">
                    <span class="placeholder" data-placeholder="Password"></span>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="login" name="login" class="btn submit_btn">Đăng nhập</button>
                    <a href="dang-ky-tai-khoan.html" value="submit" class="btn submit_btn">Đăng ký</a>
                    <div class="creat_account">
                        <input type="checkbox" id="f-option" name="selector">
                        <label for="f-option">Remember me</label>
                    </div>
                    <a class="lost_pass" href="#">Lost your password?</a>
                </div>
            </form>
    </div>
    <?php endif;?>
    <h2>Thanh toán</h2>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Thông tin khách hàng</h5>
                <div class="form-group">
                    <label>Họ tên khách hàng</label>
                    <input type="text" name="fullname"
                           value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] : '';?>"
                           class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['address'] : '';?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>SĐT</label>
                    <input type="text" min="0" name="mobile" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['phone'] : '';?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['email'] : '';?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Ghi chú thêm</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Chọn phương thức thanh toán</label> <br />
                    <input type="radio" name="method" value="0" /> Thanh toán trực tuyến <br />
                    <input type="radio" name="method" checked value="1" /> COD (dựa vào địa chỉ của bạn) <br />
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Thông tin đơn hàng của bạn</h5>
              <?php
              //biến lưu tổng giá trị đơn hàng
              $total = 0;
              if (isset($_SESSION['cart'])):
                ?>
                  <table class="table table-bordered">
                      <tbody>
                      <tr>
                          <th width="40%">Tên sản phẩm</th>
                          <th width="12%">Số lượng</th>
                          <th>Giá</th>
                          <th>Thành tiền</th>
                      </tr>
                      <?php foreach ($_SESSION['cart'] AS $product_id => $cart):
                        $product_link = 'san-pham/' . Helper::getSlug($cart['name']) . "/$product_id";
                        ?>
                          <tr>
                              <td>
                                <?php if (!empty($cart['avatar'])): ?>
                                    <img class="product-avatar img-responsive"
                                         src="../backend/assets/uploads/<?php echo $cart['avatar']; ?>" width="60"/>
                                <?php endif; ?>
                                  <div class="content-product">
                                      <a href="<?php echo $product_link; ?>" class="content-product-a">
                                        <?php echo $cart['name']; ?>
                                      </a>
                                  </div>
                              </td>
                              <td>
                              <span class="product-amount">
                                  <?php echo $cart['quantity']; ?>
                              </span>
                              </td>
                              <td>
                              <span class="product-price-payment">
                                 <?php echo number_format($cart['price'], 0, '.', '.') ?> vnđ
                              </span>
                              </td>
                              <td>
                              <span class="product-price-payment">
                                  <?php
                                  $price_total = $cart['price'] * $cart['quantity'];
                                  $total += $price_total;
                                  ?>
                                <?php echo number_format($price_total, 0, '.', '.') ?> vnđ
                              </span>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                      <tr>
                          <td colspan="5" class="product-total">
                              Tổng giá trị đơn hàng:
                              <span class="product-price">
                                <?php echo number_format($total, 0, '.', '.') ?> vnđ
                            </span>
                          </td>
                      </tr>
                      </tbody>
                  </table>
              <?php endif; ?>

            </div>
        </div>
        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary">
        <a href="gio-hang-cua-ban.html" class="btn btn-secondary">Về trang giỏ hàng</a>
    </form>
</div>