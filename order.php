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
error_reporting(0);
if (isset($_GET['customer_id'])) {
    $delCart = $cart->del_data_cart_of_session();
    session_destroy();
?> <script>
        location.replace("index.php");
    </script>
<?php
}


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
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location: login.php');
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <link href="./css/font-awesome.css" rel="stylesheet">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title><?= $name ?></title>
    <link rel="icon" href="<?= $logo ?>">

    <!-- <style>
        @media screen and (max-width: 726px) {
            .container-fluid {
                visibility: hidden;
            }
        }
    </style> -->

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
                        <a class="nav-link" style="margin-top:10px" href="index.php">Trang ch???</a>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Restaurant" id="form1">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form1').submit();">Gi???i thi???u</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Menu" id="form2">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form2').submit();">Th???c ????n</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Reservation" id="form3">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form3').submit();">?????t b??n</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Reservation' ?>" id="form3">
                            <a href="blog.php" class="nav-link" style="margin-top:10px">Tin t???c</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Gallery" id="form4">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form4').submit();">B??? s??u t???p</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Contact" id="form5">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form5').submit();">Li??n h???</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#OurLocation" id="form6">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form6').submit();">V??? tr??</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php" class="language" rel="it-IT"><i style="color:gray;font-size:16px;margin-top:22px;" class="fas fa-shopping-cart"></i></a>
                    </li>
                    <?php
                    if (isset($_GET['customer_id'])) {
                        $delCart = $cart->del_data_cart_of_session();
                        session_destroy();
                    ?> <script>
                            location.replace("index.php");
                        </script> <?php
                                }

                                $login_check = Session::get('customer_login');
                                if ($login_check == false) {
                                    ?>
                        <li class="nav-item" style="padding: 0;margin: 0;margin-left: 4px;margin-top: 10px;">
                            <a class="nav-link" href="login.php" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;padding: 8px 0;">????ng nh???p</a>
                        </li>
                    <?php
                                } else {
                    ?>
                        <li class="nav-item dropdown" style="padding: 0;margin: 0;margin-left: 4px;margin-top: 13px">
                            <a class="profile" href=""><i class="far fa-user-circle"></i></a>
                            <div class="dropdown-content">
                                <a class="nav-link" href="profile.php">T??i kho???n</a>
                                <a class="nav-link" href="orderdetails.php">????n mua</a>
                                <a class="nav-link" href="?customer_id=<?= Session::get('customer_id') ?>" style="" onclick="return confirm('B???n c?? ch???c mu???n ????ng xu???t?')">????ng xu???t</a>
                            </div>
                        </li>
                    <?php
                                }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
    <!--- End Navigation Bar -->

    <div class="container" style="width:600px;margin-top: 76;padding-bottom:120px; border: 1px solid lightgray; border-radius:10px;box-shadow: 0 0 20px rgb(0, 0, 0, 0.2);">
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" style="margin: 0;padding: 6px" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>

    <!-- Start Footer -->
    <footer style="position: absolute;
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
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/image-effect.js"></script>

    </script>
</body>

</html>
<!-- End Footer -->