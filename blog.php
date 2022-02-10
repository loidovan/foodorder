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
$blog = new blog();
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
    <script src="admin/js/ckeditor/ckeditor.js"></script>

    <title><?= $name ?></title>
    <link rel="icon" href="<?= $logo ?>">

    <style>
        .item:hover {
            box-shadow: 0 0 20px rgb(0, 0, 0, 0.3);
            cursor: pointer;
            transition-delay: 0.1s;
            transition-duration: 0.2s;
        }

        .item h5:hover {
            color: #1890ff;
        }

        .newposts {
            color: black;
            text-decoration: none;
        }

        .newposts li {
            border-left: 5px solid lightgray;
        }

        .newposts:hover li {
            color: grey;
            text-decoration: none;
            transition-delay: 0.1s;
            transition-duration: 0.2s;
            border-left: 5px solid gray;
        }
    </style>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50" style="position: relative;min-height:100%; margin:0;background-color: #fcfaf6;">
    <div id="Welcome">
        <!-- START HEADER -->
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
    <!-- END HEADER -->

    <div class="container" style="margin-top: 120px;padding-bottom: 120px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="row">
            <?php
            if (isset($_GET['blogId']) && $_GET['blogId'] != '') {
            ?>
                <div class="col-md-9 pr-0">
                    <div class="row" style="width:100%">
                        <div class="col-md-12">
                            <?php
                            $get_blog_by_id = $blog->get_blog_by_id($_GET['blogId']);
                            if ($get_blog_by_id) {
                                while ($row = $get_blog_by_id->fetch_assoc()) {
                            ?>
                                    <a href="blog.php" style="margin: 48px;color:#757575"><i class="fas fa-list"></i></a>
                                    <span style="font-size: 14px;color:#757575;float:right;margin-right: 48px;"><?= date("d/m/Y,  G:i", strtotime($row['datetime'])) ?></span>

                                    <div style="width:100%;padding-top: 24px;padding-right: 48px;padding-bottom: 48px;padding-left: 48px;" class="content">
                                        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;margin-bottom: 24px;"><?= $row['title'] ?></h1>
                                        <p style="font-size: 18px;font-family: Arial, Helvetica, sans-serif;"><?= $row['description'] ?></p>
                                        <?php echo ($row['content']) ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>

                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-9 pr-0">
                    <div class="row" style="width:100%;">
                        <!-- <div class="col-md-12 bg-danger"> -->
                        <!-- <div class="row"> -->
                        <?php

                        if (isset($_GET['keyword']) && $_GET['keyword'] !=  '') {
                            $show_blog = $blog->search_blog($_GET['keyword']);
                        } else {
                            $show_blog = $blog->show_blog();
                        }
                        if ($show_blog) {
                            while ($row = $show_blog->fetch_assoc()) {
                        ?>
                                <div class="item" style="display: flex;margin-bottom: 24px;border-radius: 5px;min-height: 198px;">
                                    <div class="col-md-4 p-0">
                                        <a href="blog.php?blogId=<?= $row['id'] ?>">
                                            <img src="admin/uploads/<?= $row['image'] ?>" width="100%" height="100%" style="border-radius: 5px;" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-8 p-3" style="border-radius: 5px;border: 1px solid #DDDDDD;border-left: none;background-color:white">
                                        <a style="color:black;text-decoration: none;" href="blog.php?blogId=<?= $row['id'] ?>">
                                            <h5><?= $row['title'] ?></h5>
                                        </a>
                                        <p><?= $row['description'] ?></p>
                                        <p style="font-size: 12px;color:grey"><i class="far fa-calendar-alt"></i> <?= date("d/m/Y ", strtotime($row['datetime'])) ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <!-- PHÂN TRANG -->
                        <nav aria-label="Page navigation example" style="margin-right: auto;margin-left: auto;">
                            <ul class="pagination justify-content-end mr-5">
                                <li class="page-item">
                                    <?php

                                    $url_search = isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : '';

                                    if (!isset($_GET['page']) || $_GET['page'] == 1) {
                                        $previous = 1;
                                    } else {
                                        $previous = $_GET['page'] - 1;
                                    }
                                    ?>
                                    <a class="page-link" href="?page=<?= $previous . $url_search ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                $show_page_blog = $blog->show_page_blog();
                                if ($show_page_blog != null) {
                                    $blog_count = mysqli_num_rows($show_page_blog);
                                } else {
                                    $blog_count = 0;
                                }
                                $blog_link = ceil($blog_count / 6);
                                $i = 1;
                                for ($i = 1; $i <= $blog_link; $i++) {
                                    if (!isset($_GET['page'])) {
                                        if ($i == 1) {

                                ?>
                                            <li class="page-item active"><a class="page-link" href="?page=<?= $i .  $url_search ?>"><?= $i ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $i .  $url_search ?>"><?= $i ?></a></li>
                                        <?php
                                        }
                                    } else {
                                        if ($_GET['page'] == $i) {
                                        ?>
                                            <li class="page-item active"><a class="page-link" href="?page=<?= $i .  $url_search ?>"><?= $i ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $i .  $url_search ?>"><?= $i ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                <?php
                                }
                                ?>

                                <li class="page-item">
                                    <?php
                                    if (!isset($_GET['page'])) {
                                        $next = 2;
                                        if ($next > $blog_link) {
                                            $next = $next - 1;
                                        }
                                    } else {
                                        $next = $_GET['page'] + 1;
                                        if ($next > $blog_link) {
                                            $next = $next - 1;
                                        }
                                    }
                                    ?>
                                    <a class="page-link" href="?page=<?= $next .  $url_search ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- HẾT PHÂN TRANG -->
                </div>
            <?php
            }
            ?>


            <div class="col-md-3">
                <form action="" method="get" autocomplete="off">
                    <div class="input-group">
                        <input type="text" name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" style="height: 32px;" class="form-control m-0 pl-2" placeholder="Tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary m-0" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>

                <h6 class="mt-4 mb-4">BÀI VIẾT MỚI</h6>
                <ul style="list-style-type: none;" class="p-0">
                    <?php
                    $show_new_posts = $blog->show_all_blog_admin();
                    $count = 0;
                    if ($show_new_posts) {
                        while ($row = $show_new_posts->fetch_assoc()) {
                            if ($count < 6) {
                    ?>
                                <a class="newposts" style="text-decoration: none;" href="blog.php?blogId=<?= $row['id'] ?>">
                                    <li style="padding: 4px 10px 0;margin-bottom: 12px;min-height:54px;">
                                        <div style="border-bottom: 1px solid lightgray;height: 58px;"><?= $row['title'] ?></div>
                                    </li>
                                </a>
                    <?php
                            }
                            $count++;
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
    <!-- HẾT THỰC ĐƠN -->

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
    <script type="text/javascript" src="js/pagination.min.js"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/image-effect.js"></script>

    </script>
</body>

</html>
<!-- End Footer -->