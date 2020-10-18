<?php

?>

<?php if (isset($_SESSION['user'])) :
    $user = $_SESSION['user']; ?>
    <div class="container-fluid ">
        <h2>Thông tin cá nhân của bạn : <b><?php echo $user['username']; ?></b></h2>
        <div class="row profile">
            <form class="row" action="" method="post" enctype="multipart/form-data">
                <div class="col-md-1 col-12"></div>
                <div class="col-md-5 col-12">

                    <img height="300px" src="../backend/assets/uploads/<?php echo $user['avatar'] ?>" >
                    <br>
                    Update avatar : <input type="file" name="avatar">
                </div>
                <div class="col-md-1 col-12"></div>
                <div class="col-md-5 col-12">

                    <table class=" table">
                        <tr>
                            <td>Full name</td>
                            <td><input type="text" class="input-append" name="first_name" value="<?php echo $user['first_name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Full name</td>
                            <td><input type="text" name="last_name" value="<?php echo $user['last_name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <!--                        <td>--><?php //echo $user['address']
                            ?><!--</td>-->
                            <td><input type="text" name="address" value="<?php echo $user['address'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" value="<?php echo $user['email'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td><input type="text" name="phone" value="<?php echo $user['phone'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td><input type="text" name="jobs" value="<?php echo $user['jobs'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Facebook</td>
                            <td><input type="text" class="input-append" name="facebook" value="<?php echo $user['facebook'] ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <!--                        <td></td>-->
                            <td><input type="submit" name="update" value="Cập nhật"></td>
                        </tr>
                    </table>


                </div>
            </form>
        </div>


    </div>
<?php else: ?>
    <div class="container-fluid " style="text-align: center">
        <h2> Bạn chưa đăng nhập nên không có thông tin</h2><br>
        <a class="btn btn-primary" href="login.html">Đăng nhập</a>
    </div>


<?php endif; ?>
