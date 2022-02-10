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

if (!isset($_GET['foodId']) && $_GET['foodId'] == NULL) {
    echo "<script>window.location = 'index.php' </script>";
} else {
    $foodId = $_GET['foodId'];
}
$show_details = $food->get_byId($foodId);
if (!$show_details) {
    echo "<script>window.location = 'index.php' </script>";
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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addToCart = $cart->add_to_cart($quantity, $foodId);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $checkLogin = Session::get('customer_login');
    if ($checkLogin == true) {
        $customerName = Session::get('customer_name');
        $foodId = $_GET['foodId'];
        $content = $_POST['content'];

        $comment_check = $food->comment_food($customerName, $foodId, $content);
    } else {
        $checkLogin = '<div class="alert alert-warning text-center" role="alert">Để có thể bình luận xin mời đăng nhập</div>';
    }
}
?>

<?php
if (isset($_GET['likeId']) && isset($_GET['customerId'])) {
    if ($_GET['customerId'] != '') {
        $likeId = $_GET['likeId'];

        $like_check = $food->like_comment($likeId);
    } else {
        $like = '<div class="alert alert-warning text-center" role="alert">Để có thể like xin mời đăng nhập</div>';
    }
} elseif (isset($_GET['foodId']) && isset($_GET['likeId']) && isset($_GET['customerId'])) {
    $like = '<div class="alert alert-warning text-center" role="alert">Để có thể like xin mời đăng nhập</div>';
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

    <style>
        .item:hover .title {
            color: #1890ff;
        }
    </style>

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
    <form action="" method="post">
        <div class="container" style="margin-top: 132px;margin-bottom:50px">
            <div class="row">
                <div class="col-md-11 ml-4">
                    <?php
                    if (isset($addToCart)) {
                        echo $addToCart;
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <?php
                $show_details = $food->get_byId($foodId);
                if ($show_details) {
                    while ($row = $show_details->fetch_assoc()) {
                ?>
                        <div class="col-xs-4 ml-4">
                            <div class="card-body" style="padding: 0;">
                                <img width="330px" height="246px" style="border:1px solid lightgray;box-shadow: 0 0 20px rgb(0 0 0 / 20%);border-radius:10px" src="<?= 'admin/uploads/' . $row['image'] ?>" width="330px" alt="">

                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="ml-4" style="padding: 5px 10px;border-radius:10px;box-shadow: 0 0 5px rgb(0 0 0 / 10%);background-color:#fafafa">
                                <h3 style="word-wrap: break-word;">
                                    <?php
                                    if ($row['type'] == 1) {
                                    ?>
                                        <span style="font-size: 13px; border: 1px solid tomato;padding:5px 6px;border-radius:4px;background-color:tomato;font-weight: 700;color:white;">Nổi bật</span>
                                    <?php
                                    }
                                    ?>
                                    <?= $row['foodName'] ?>
                                </h3>
                                <?php
                                $show_discount = $config->show_config();
                                if ($show_discount) {
                                    while ($row2 = $show_discount->fetch_assoc()) {
                                        $discount = (float)$row['price'] * (float)$row2['discount'] / 100;
                                        $discount += (float)$row['price'];
                                        $discount = number_format($discount, 0, '', '.');
                                        $discount = $discount . '₫';

                                        $discount2 = $row2['discount'] . '% giảm';
                                        $category = $row['foodIdCategory'];
                                    }
                                }
                                ?>
                                <p style="font-size: 24px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><?php echo '<del  style="color: #929292;font-size:18px"><span>' . $discount . '</span></del> '
                                                                                                                            . number_format($row['price'], 0, '', '.') . '₫' ?>
                                    <span style="font-size: 14px;padding: 2px 3px;border:1px solid tomato;background-color:LightSalmon;border-radius:5px;margin-left:5px"><?= $discount2  ?></span>
                                </p>
                                <div class="ml-4">
                                    <p><?= $row['description'] ?></p>
                                </div>
                            </div>

                            <div class="ml-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" style="background-color: grey;border: 1px solid grey" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                </button>
                                            </span>
                                            <input type="text" style="height:38px;border-radius:4px" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" style="background-color: grey;border: 1px solid grey" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                    <span class="glyphicon glyphicon-plus">+</span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary w-25" type="submit" name="submit">Mua ngay</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                <?php
                    }
                }

                ?>
            </div>
        </div>
    </form>

    <section class="content-item" id="comments" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form action="" method="post">
                        <h3 class="pull-left">Ý kiến</h3>
                        <?php
                        if (isset($checkLogin)) {
                            if ($checkLogin != 1) {
                                echo $checkLogin;
                            }
                            if (isset($comment_check)) {
                                echo $comment_check;
                            }
                        } elseif (isset($like)) {
                            $cus = Session::get('customer_login');
                            if ($cus !=  true) {
                                echo $like;
                            }
                        }
                        ?>
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2 hidden-xs">
                                    <img class="img-responsive" width="98px" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <textarea maxlength="500" name="content" class="form-control" id="message" placeholder="Ý kiến của bạn" required=""></textarea>
                                </div>
                            </div>

                            <button type="submit" name="comment" class="w-25 btn pull-right">Gửi bình luận</button>

                        </fieldset>
                    </form>

                    <?php
                    $count_cmt = $food->count_comment(isset($_GET['foodId']) ? $_GET['foodId'] : '');
                    if ($count_cmt) {
                        while ($row = $count_cmt->fetch_assoc()) {
                    ?>
                            <h3><?= $row['sl'] . ' bình luận' ?></h3>
                    <?php
                        }
                    }
                    ?>


                    <!-- COMMENT 1 - START -->
                    <?php
                    $show_comment = $food->show_all_comment_customer(isset($_GET['foodId']) ? $_GET['foodId'] : '');
                    if ($show_comment) {
                        $count = 0;
                        while ($row = $show_comment->fetch_assoc()) {
                            if ($row['cmtId'] % 2 == 0) {
                                $img = 'https://bootdey.com/img/Content/avatar/avatar1.png';
                            } else {
                                $img = 'https://bootdey.com/img/Content/avatar/avatar4.png';
                            }

                            if (!isset($_GET['viewmore'])) {
                                if ($count < 4) {
                    ?>
                                    <div class="media">
                                        <a class="pull-left" href="#"><img width="72px" class="media-object" src="<?= $img ?>" alt=""></a>
                                        <div class="media-body">
                                            <h5 class="media-heading"><?= $row['cmtName'] ?></h5>
                                            <p><?= $row['cmtContent'] ?></p>
                                            <a style="font-size: 12px;opacity: 0.8;"><i class="far fa-calendar-alt"></i> <?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></a>
                                            <a style="font-size: 12px;opacity: 0.8;margin-left: 16px;"><i class="fa fa-thumbs-up"></i> <?= $row['quantitylike'] ?></a>

                                            <ul class="list-unstyled list-inline media-detail pull-right">
                                                <?php
                                                $customerId = Session::get('customer_id');
                                                if (isset($customerId)) {
                                                    $customerId = '&customerId=' . $customerId;
                                                }
                                                ?>
                                                <li class=""><a href="?foodId=<?= $foodId ?>&likeId=<?= $row['cmtId'] ?><?= $customerId ?>">Like</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php

                                }
                            } elseif (isset($_GET['viewmore'])) {
                                ?>
                                <div class="media">
                                    <a class="pull-left" href="#"><img width="72px" class="media-object" src="<?= $img ?>" alt=""></a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?= $row['cmtName'] ?></h5>
                                        <p><?= $row['cmtContent'] ?></p>
                                        <a style="font-size: 12px;opacity: 0.8;"><i class="far fa-calendar-alt"></i> <?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></a>
                                        <a style="font-size: 12px;opacity: 0.8;margin-left: 16px;"><i class="fa fa-thumbs-up"></i> <?= $row['quantitylike'] ?></a>

                                        <ul class="list-unstyled list-inline media-detail pull-right">
                                            <?php
                                            $customerId = Session::get('customer_id');
                                            if (isset($customerId)) {
                                                $customerId = '&customerId=' . $customerId;
                                            }
                                            ?>
                                            <li class=""><a name="likecmt" href="?foodId=<?= $foodId ?>&likeId=<?= $row['cmtId'] ?><?= $customerId ?>">Like</a></li>

                                        </ul>
                                    </div>
                                </div>
                            <?php
                            }
                            $count++;
                            ?>
                    <?php
                        }
                    }
                    ?>

                    <!-- COMMENT 1 - END -->

                    <div class="text-center">
                        <a href="?foodId=<?= $foodId ?>&viewmore=yes"><input type="button" class="btn btn-link" value="Xem thêm"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 1) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>


    <div class="container mt-5" style="padding: 0 30px; padding-bottom: 120px;">
        <h6 style="margin-bottom:6px;font-weight: 500;">Món ăn tương tự <a href="menu.php" class="btn btn-outline-secondary btn-sm text-center" style="width:100px;">Xem thêm</a></h6>
        <div class="row" style="box-shadow: 0 0 10px rgb(0 0 0 / 5%);border: 1px solid #CCCCCC;padding: 15px;border-radius:10px; padding-bottom:0;padding-left: 46px;">
            <?php
            $show_menu = $food->get_by_category($category, $foodId);
            if ($show_menu) {
                $count = 0;
                while ($row = $show_menu->fetch_assoc()) {
                    if ($count < 6) {
            ?>
                        <div class="col-md-2">
                            <a class="item" href="details.php?foodId=<?= $row['foodId'] ?>" style="color: black;text-decoration: none;">
                                <img width="100px" height="75px" style="border-radius:5px;border: 1px solid lightgrey; box-shadow: 0 0 5px rgb(0 0 0 / 20%);" src="<?= 'admin/uploads/' . $row['image'] ?>" alt="">
                                <p class="title" style="font-size: 14px;white-space: nowrap; 
                            width: 106px; 
                            overflow: hidden;
                            text-overflow: ellipsis;margin:0;text-align: center;font-weight: 500;"><?= $row['foodName'] ?></p>
                                <p style="margin: 0;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:13px;text-align: center;margin-bottom:8px;width:100px;color: orangered;"><?= number_format($row['price'], 0, '', '.') . '₫' ?></p>
                            </a>
                        </div>
            <?php
                        $count++;
                    }
                }
            }
            ?>

        </div>
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