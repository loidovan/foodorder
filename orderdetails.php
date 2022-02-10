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

<?php

if (isset($_GET['receiveOrderId']) && !isset($_GET['deleteOrderId'])) {
    $orderId = $_GET['receiveOrderId'];
    $update_check = $cart->receive_order($orderId);
}

if (!isset($_GET['receiveOrderId']) && isset($_GET['deleteOrderId'])) {
    $orderId = $_GET['deleteOrderId'];
    $delete_check = $cart->delete_order($orderId);
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

    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title><?= $name ?></title>
    <link rel="icon" href="<?= $logo ?>">

    <!-- <style>
        @media screen and (max-width: 726px) {
            .container-fluid {
                visibility: hidden;
            }
        }

        .container-fluid {
            visibility: hidden;
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
                        <a class="nav-link" style="margin-top:10px" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Restaurant" id="form1">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form1').submit();">Giới thiệu</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Menu" id="form2">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form2').submit();">Thực đơn</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Reservation" id="form3">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form3').submit();">Đặt bàn</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="<?= 'index.php#Reservation' ?>" id="form3">
                            <a href="blog.php" class="nav-link" style="margin-top:10px">Tin tức</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Gallery" id="form4">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form4').submit();">Bộ sưu tập</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#Contact" id="form5">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form5').submit();">Liên hệ</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="index.php#OurLocation" id="form6">
                            <a href="#" class="nav-link" style="margin-top:10px" onclick="document.getElementById('form6').submit();">Vị trí</a>
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
                            <a class="nav-link" href="login.php" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;padding: 8px 0;">Đăng nhập</a>
                        </li>
                    <?php
                                } else {
                    ?>
                        <li class="nav-item dropdown" style="padding: 0;margin: 0;margin-left: 4px;margin-top: 13px">
                            <a class="profile" href=""><i class="far fa-user-circle"></i></a>
                            <div class="dropdown-content">
                                <a class="nav-link" href="profile.php">Tài khoản</a>
                                <a class="nav-link" href="orderdetails.php">Đơn mua</a>
                                <a class="nav-link" href="?customer_id=<?= Session::get('customer_id') ?>" style="" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">Đăng xuất</a>
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
    <!--- Start Carousel -->
    <!-- Cart -->
    <form action="" method="post" style="margin: 0;">
        <div class="container" style="margin-top: 76px;padding-bottom:120px">
            <div class="col-lg-12 col-sm-12">
                <span class="title"> ĐƠN MUA</span>
                <?php
                if (isset($delete_check)) {
                    echo $delete_check;
                } elseif (isset($update_check)) {
                    echo $update_check;
                }
                ?>
            </div>
            <div class="col-lg-12 col-sm-12 hero-feature">
                <div class="table-responsive">


                    <table class="table table-bordered tbl-cart" style="font-size: 16px;">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td class="hidden-xs">Ảnh</td>
                                <td>Tên món</td>
                                <td class="td-qty">Số lượng</td>
                                <td>Thành tiền</td>
                                <td>Ngày mua</td>
                                <td>Trạng thái</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $customerId = Session::get('customer_id');

                            $get_orderdetails = $cart->show_orderdetails(isset($customerId) ? $customerId : 0);
                            if ($get_orderdetails) {
                                $count = 1;
                                while ($row = $get_orderdetails->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td style="width:5%"><?= $count ?></td>
                                        <td class="hidden-xs text-center" style="padding: 0;">
                                            <a href="<?= 'details.php?foodId=' . $row['foodId'] ?>">
                                                <img src="<?= 'admin/uploads/' . $row['image'] ?>" alt="Age Of Wisdom Tan Graphic Tee" title="" width="80px" height="70px">
                                            </a>
                                        </td>
                                        <td><a href="<?= 'details.php?foodId=' . $row['foodId'] ?>"><?= $row['foodName'] ?></a>
                                        </td>

                                        <td style="width:10%">
                                            <input type="text" style="height:38px;border:none;background-color: unset;" id="quantity<?= $count ?>" name="quantity<?= $count ?>" class="form-control input-number text-center" value="<?= $row['quantity'] ?>" min="1" max="100" readonly="readonly">

                                        </td>
                                        <td class="price"><span style="float: right;"><?= number_format($row['price'], 0, '', '.') . '₫' ?></span></td>
                                        <td style="width:16%"><?= date("d/m/Y  G:i", strtotime($row['datetime'])); ?></td>
                                        <td style="width:14%">
                                            <?php
                                            if ($row['status'] == 0) {
                                                echo '<div class="alert alert-danger m-0 text-center" role="alert">Đang xử lý</div>';
                                            } elseif ($row['status'] == 1) {
                                                echo '<a name="receive" href="?receiveOrderId=' . $row['orderId'] . '"><div class="alert alert-warning m-0 text-center" role="alert">Nhận hàng</div></a>';
                                            } else {
                                                echo '<div class="alert alert-success m-0 text-center" role="alert">Đã nhận hàng</div>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['status'] == 1) {
                                            ?>
                                                N/A
                                            <?php
                                            } else {
                                            ?>
                                                <a href="?deleteOrderId=<?= $row['orderId'] ?>" name="delete" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="remove_cart" rel="2">
                                                    <i style="font-size: 16px;color:tomato" class="fas fa-times"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>

                            <?php
                                    $count++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>



            </div>


        </div>
        <!-- End Cart -->
    </form>


    <!-- Start Footer -->
    <footer style="position: absolute;
   left: 0;
   bottom: 0;
   width: 100%;">
        <div id="mu-footer">
            <div class="container-fluid">
                <div class="row" style="background-color: #444444;height: 100px;">
                    <div class="col-md-12" style="padding-bottom:0;">
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