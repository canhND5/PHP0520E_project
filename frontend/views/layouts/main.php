<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title>Fashiop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
<!--    //-->
    <link rel="stylesheet" href="vendors/linericon/style.css">
<!--    //-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
<!--    //-->
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
<!--    //-->
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/restyle.css">
</head>


<body>

<!--================Header Menu Area =================-->
<?php require_once 'header.php'; ?>
<!--================Header Menu Area =================-->

<!--================Hot Deals Area =================-->

<!--================End Hot Deals Area =================-->


<!--================Feature Product Area =================-->
<div class="main-content">
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($this->error)): ?>
            <div class="alert alert-danger">
                <?php
                echo $this->error;
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="" style="min-height: 500px">

        <?php echo $this->content; ?>
    </div>
</div>



<!--================ start footer Area  =================-->
<?php require_once 'footer.php'; ?>
<!--================ End footer Area  =================-->


</body>

</html>