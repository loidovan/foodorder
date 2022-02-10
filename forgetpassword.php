<?php
include './lib/session.php';
Session::init();
?>

<?php

include_once './lib/database.php';
include_once './helpers/format.php';

spl_autoload_register(function ($className) {
    include_once 'classes/' . $className . '.php';
});

$db = new Database();
$fm = new Format();
$cart = new cart;
$cate = new category();
$food = new food();
$customer = new customer();

$config = new configs();
?>

<?php

$show_name = $config->show_config();
if ($show_name) {
    while ($row = $show_name->fetch_assoc()) {
        $name_logo = explode('/', $row['name']);
        $name = $name_logo[0];
        $logo = './admin/uploads/logo/' . $row['logo'];
    }
}

?>

<?php

    if (isset($_POST['forget']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        $forget_check = $customer->forget_password($email, $phone);
    }
?>


<html style="height: 500px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <link href="./css/font-awesome.css" rel="stylesheet">
    <link href="./css/style-login-register.css" rel="stylesheet" type="text/css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title><?= $name ?></title>
    <link rel="icon" href="<?= $logo ?>">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50" style="position: relative;min-height:100%; margin:0;">
    <div id="Welcome">
        <!-- -Start navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar fixed-top  navbar-light bg-light">
            <a class="navbar-brand" href="index.php">
                <img src="<?= $logo ?>" width="50" height="50" class="d-inline-block" alt=""> <?= $name ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="margin-top:4px" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Restaurant' ?>" id="form1">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form1').submit();">Giới thiệu</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Menu' ?>" id="form2">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form2').submit();">Thực đơn</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Reservation' ?>" id="form3">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form3').submit();">Đặt bàn</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Gallery' ?>" id="form4">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form4').submit();">Bộ sưu tập</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Contact' ?>" id="form5">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form5').submit();">Liên hệ</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#OurLocation' ?>" id="form6">
                            <a href="#" class="nav-link" style="margin-top:4px" onclick="document.getElementById('form6').submit();">Vị trí</a>
                        </form>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
    <!--- End Navigation Bar -->
    
    <div class="wrapper" style="width:600px;margin: 0;">
    <input type="text" value="Quên Mật Khẩu" disabled style="background-color: white;border:none;font-size:18px;margin: 0;padding:0;font-weight: 600;"> 
       
    <div class="form-container">
            <div class="form-inner">
                <form action="" class="login" method="post">
                    <div class="field">
                        <input type="email" id="title" value="<?= isset($_POST['loginemail']) ? $_POST['loginemail'] : '' ?>" name="email" placeholder="Nhập tài khoản email" required>
                    </div>
                    <div class="field">
                        <input autocomplete="off" type="text" value="<?= isset($_POST['loginpassword']) ? $_POST['loginpassword'] : '' ?>" name="phone" placeholder="Nhập số điện thoại đăng ký" required>
                    </div>
                    
                    <?php
                    if (isset($forget_check)) {
                        echo $forget_check;
                    }
                    ?>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" style="margin-top: 4px;" name="forget" value="Lấy lại mật khẩu">
                    </div>
                    <div class="signup-link">
                        Bạn đã biết mật khẩu? <a href="login.php">Đăng nhập</a>
                    </div>


                </form>
              
            </div>
        </div>
    </div>



    <!-- Start Footer -->
    <footer style="position: fixed;margin-top: 100px;
   left: 0;
   bottom: 0;
   width: 100%;">
        <div id="mu-footer">
            <div class="container-fluid">
                <div class="row" style="background-color: #444444;height: 100px;">
                    <div class="col-md-12">
                        <div class="mu-footer-area">
                            <div class="mu-footer-social mt-4" style="text-align: center;">
                                <a href="https://www.facebook.com/"><i style="font-size: 20px;" class="fab fa-facebook"></i></span></a>
                                <a href="https://www.instagram.com/"><i style="font-size: 20px;" class="fab fa-instagram"></i></span></a>
                                <a href="https://www.youtube.com/"><i style="font-size: 20px;" class="fab fa-youtube"></i></span></a>
                                <a href="https://www.google.com/"><i style="font-size: 20px;" class="fab fa-google-plus-g"></i></span></a>
                            </div>
                            <div class="mu-footer-copyright" style="text-align: center;color:antiquewhite">
                                <p>Copyright &copy; 2021 - Developed by <a style="color: lightblue;" rel="nofollow" href="https://www.facebook.com/doloi01/">Do Loi</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script type="text/javascript" src="js/map.js"></script>
    <script type="text/javascript" src="js/smooth-scroll.js"></script>
    <script type="text/javascript" src="js/pagination.min.js"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/image-effect.js"></script>

    </script>
</body>

</html>
<!-- End Footer -->