<?php
//views/users/register.php
?>

<section class="login_box_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="assets/images/login.jpg" alt="">
                    <div class="hover">
                        <h4>Bạn đã có tài khoản ?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="main_btn" href="login.html">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner reg_form">
                    <h3>Create an Account</h3>
                    <form class="row login_form" action="" method="post" id="contactForm" novalidate="novalidate">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control"  name="username" placeholder="Username">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control"  name="email" placeholder="Email Address">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control"  name="password" placeholder="Password">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control"  name="confirm_password" placeholder="Confirm password">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" name="register" value="register" class="btn submit_btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

