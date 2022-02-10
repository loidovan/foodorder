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

    <title><?= $name ?></title>
    <link rel="icon" href="<?= $logo ?>">

    <style>
        .item:hover {
            box-shadow: 0 0 10px rgb(0, 0, 0, 0.3);
            cursor: pointer;
            transition-delay: 0.1s;
            transition-duration: 0.2s;
        }

        .item h5:hover {
            color: #1890ff;
        }
    </style>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50" style="position: relative;min-height:100%; margin:0;">
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

    <div class="container" style="margin-top: 76px;padding-bottom: 120px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="row">
            <!-- DANH MỤC -->
            <div class="col-lg-2 p-0">
                <div style="border-top: 1px solid #DDDDDD;border-bottom: 1px solid #DDDDDD; margin-top: 38px;margin-bottom: 12px;padding-top: 12px;">
                    <a href="menu.php" style="color:#444444"><span style="font-weight: 600;font-size: 15px;margin-left: 2px;">Danh Mục Món Ăn</span></a>

                    <ul style="list-style-type: none;padding: 12px 12px;margin-bottom: 0;padding-top: 6px;">

                        <?php
                        $show_cate = $cate->show_category();
                        if ($show_cate) {
                            while ($row = $show_cate->fetch_assoc()) {
                                if (isset($_GET['page'])) {
                                    $page_on_url = 'page=1';
                                } else {
                                    $page_on_url = '';
                                }
                                if (isset($_GET['cate'])) {
                                    if ($_GET['cate'] == $row['cateId']) {
                        ?>
                                        <a style="color:#1890ff;" href="<?= 'menu.php?' . $page_on_url . '&cate=' . $row['cateId'] ?>">
                                            <li style="padding: 2px;"><?= $row['cateName'] ?></li>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a style="color:black;" href="<?= 'menu.php?' . $page_on_url . '&cate=' . $row['cateId'] ?>">
                                            <li style="padding: 2px;"><?= $row['cateName'] ?></li>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                ?>
                                    <a style="color:black;" href="<?= 'menu.php?' . $page_on_url . '&cate=' . $row['cateId'] ?>">
                                        <li style="padding: 2px;"><?= $row['cateName'] ?></li>
                                    </a>
                        <?php
                                }
                            }
                        }
                        ?>
                </div>
                <!-- HẾT DANH MỤC -->

                <!-- KHOẢNG GIÁ -->
                <div>
                    <form action="" method="get" onsubmit="return myValidation()">
                        <span style="margin-left: 2px; font-weight: 600;font-size: 15px;margin-top: 12px;">Khoảng Giá</span>
                        <?php
                        if (isset($_GET['page'])) {
                        ?>
                            <input type="hidden" name="page" value="<?= $_GET['page'] ?>" class="form-control" style="width:180px;height: 31px;padding: 12px 10px;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" placeholder="Nhập từ khóa" aria-label="Recipient's username" aria-describedby="basic-addon2">

                        <?php
                        }
                        if (isset($_GET['cate'])) {
                        ?>
                            <input type="hidden" name="cate" value="<?= $_GET['cate'] ?>" class="form-control" style="width:180px;height: 31px;padding: 12px 10px;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" placeholder="Nhập từ khóa" aria-label="Recipient's username" aria-describedby="basic-addon2">

                        <?php
                        }
                        if (isset($_GET['sort'])) {
                        ?>
                            <input type="hidden" name="sort" value="<?php if ($_GET['sort'] == 'asc') echo 'asc';
                                                                    elseif ($_GET['sort'] == 'desc') echo 'desc';
                                                                    elseif ($_GET['sort'] == 'top') echo 'top'; ?>" class="form-control" style="width:180px;height: 31px;padding: 12px 10px;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" placeholder="Nhập từ khóa" aria-label="Recipient's username" aria-describedby="basic-addon2">

                        <?php
                        }
                        if (isset($_GET['search'])) {
                        ?>
                            <input type="hidden" name="search" value="<?= $_GET['search'] ?>" class="form-control" style="width:180px;height: 31px;padding: 12px 10px;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" placeholder="Nhập từ khóa" aria-label="Recipient's username" aria-describedby="basic-addon2">

                        <?php
                        }
                        ?>
                        <div class="row mt-1">
                            <div class="col-sm-5 pr-0"><input style="height:30px;outline: none;padding: 12px 10px;font-size: 12px;border-radius:3px;box-shadow: 0 0 5px rgb(0, 0, 0, 0.2);" name="minPrice" value="<?= isset($_GET['minPrice']) ? $_GET['minPrice'] : '' ?>" id="minPrice" type="text" placeholder="₫ Từ"></div>
                            <div class="col-sm-2 p-0" style="text-align: center;font-size:26px;opacity: 0.7;">-</div>
                            <div class="col-sm-5 pl-0"><input style="height:30px;outline: none;padding: 12px 10px;font-size: 12px;border-radius:3px;box-shadow: 0 0 5px rgb(0, 0, 0, 0.2);" name="maxPrice" value="<?= isset($_GET['maxPrice']) ? $_GET['maxPrice'] : '' ?>" id="maxPrice" type="text" placeholder="₫ Đến"></div>
                        </div>
                        <h6 id="errorPrice" style="color:tomato;text-align: center;font-size:12px"></h6>
                        <div class="row m-0"><button type="submit" class="btn btn-light btn-sm w-100" style="box-shadow: 0 0 5px rgb(0, 0, 0, 0.3);margin-right: 2px;">Áp Dụng</button></div>
                    </form>
                    <script>
                        function myValidation() {
                            var minVal = document.getElementById("minPrice").value;
                            var maxVal = document.getElementById("maxPrice").value;
                            if (maxVal == '') {
                                maxVal = '0';
                            }
                            if ((parseFloat(minVal) > parseFloat(maxVal)) || (minVal == '' && maxVal == '0')) {
                                document.getElementById("errorPrice").innerHTML = 'Vui lòng điền khoảng giá phù hợp';
                                //returnToPreviousPage();
                                return false;
                            } else {
                                return true;
                            }

                        }
                    </script>
                </div>
            </div>
            <!-- Ko cho nhập chữ và ký tự -->
            <script>
                document.querySelector("input").addEventListener("keypress", function(evt) {
                    if (evt.which < 48 || evt.which > 57) {
                        evt.preventDefault();
                    }
                });
            </script>
            <!-- HẾT KHOẢNG GIÁ -->

            <!-- THỰC ĐƠN -->
            <div class="col-lg-10" style="background-color: white;">
                <div class="row">
                    <!-- SẮP XẾP -->
                    <div class="col-md-8">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" style="width:150px;margin-left: 38px;box-shadow: 0 0 4px rgb(0,0,0,0.2);" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                if (isset($_GET['sort'])) {
                                    if ($_GET['sort'] == 'asc') {
                                        echo 'Giá: Thấp đến Cao';
                                    } elseif ($_GET['sort'] == 'desc') {
                                        echo 'Giá: Cao đến Thấp';
                                    } elseif ($_GET['sort'] == 'top') {
                                        echo 'Bán chạy';
                                    } else {
                                        echo 'Sắp xếp theo';
                                        $delfault = 'Sắp xếp theo';
                                    }
                                } else {
                                    echo 'Sắp xếp theo';
                                    $delfault = 'Sắp xếp theo';
                                }
                                ?>
                            </button>

                            <?php
                            if (isset($_GET['page']) || isset($_GET['cate']) || isset($_GET['search']) || isset($_GET['minPrice'])) {
                                $p = isset($_GET['page']) ? '?page=' . $_GET['page'] : '';
                                if (!isset($_GET['page'])) {
                                    $c = isset($_GET['cate']) ? '?cate=' . $_GET['cate'] : '';
                                    if (!isset($_GET['cate'])) {
                                        $s = isset($_GET['search']) ? '?search=' . $_GET['search'] : '';
                                    } else {
                                        $s = isset($_GET['search']) ? '&search=' . $_GET['search'] : '';
                                    }
                                } else {
                                    $c = isset($_GET['cate']) ? '&cate=' . $_GET['cate'] : '';
                                    $s = isset($_GET['search']) ? '&search=' . $_GET['search'] : '';
                                }

                                if (!isset($_GET['search']) && !isset($_GET['cate']) && !isset($_GET['search']) && !isset($_GET['page'])) {
                                    $minP = isset($_GET['minPrice']) ? '?minPrice=' . $_GET['minPrice'] : '';
                                    $maxP = isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '';
                                } else {
                                    $minP = isset($_GET['minPrice']) ? '&minPrice=' . $_GET['minPrice'] : '';
                                    $maxP = isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '';
                                }

                                $asc = $p . $c . $s . $minP . $maxP . '&sort=asc';
                                $desc = $p . $c . $s . $minP . $maxP . '&sort=desc';
                                $top = $p . $c . $s . $minP . $maxP . '&sort=top';
                            } elseif (!isset($_GET['page']) && !isset($_GET['cate']) && !isset($_GET['search']) && !isset($_GET['minPrice']) && !isset($_GET['maxPrice'])) {
                                $asc = '?sort=asc';
                                $desc = '?sort=desc';
                                $top = '?sort=top';
                            }

                            ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?= $asc ?>">Giá từ thấp đến cao</a>
                                <a class="dropdown-item" href="<?= $desc ?>">Giá từ cao đến thấp</a>
                                <a class="dropdown-item" href="<?= $top ?>">Bán chạy</a>
                            </div>

                        </div>
                        <?php
                        if (isset($delfault)) {
                            echo '<button class="btn btn-light btn-sm ml-2" style="width:80px;cursor: unset;box-shadow: 0 0 3px rgb(0, 0, 0, 0.3);background-color:#f8f9fa">Mới nhất</button>';
                        }
                        ?>
                        <!-- HẾT SẮP XẾP -->
                    </div>

                    <!-- TÌM KIẾM -->
                    <div class="col-md-4" style="text-align: right;">

                        <form action="menu.php" method="GET" style="padding: 0;margin: 0;">
                            <div class="input-group" style="padding-right: 30px;">
                                <input type="text" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" class="form-control" style="width:180px;height: 31px;padding: 12px 10px;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" placeholder="Nhập từ khóa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <?php
                                if (isset($_GET['page'])) {
                                ?>
                                    <input type="hidden" name="page" value="<?= '1' ?>">

                                <?php
                                }
                                if (isset($_GET['cate'])) {
                                ?>
                                    <input type="hidden" name="cate" value="<?= $_GET['cate'] ?>">

                                <?php
                                }
                                if (isset($_GET['sort'])) {
                                ?>
                                    <input type="hidden" name="sort" value="<?php if ($_GET['sort'] == 'asc') echo 'asc';
                                                                            elseif ($_GET['sort'] == 'desc') echo 'desc';
                                                                            elseif ($_GET['sort'] == 'top') echo 'top'; ?>">

                                <?php
                                }
                                if (isset($_GET['minPrice'])) {
                                ?>
                                    <input type="hidden" name="minPrice" value="<?= $_GET['minPrice'] ?>">

                                <?php
                                }
                                if (isset($_GET['maxPrice'])) {
                                ?>
                                    <input type="hidden" name="maxPrice" value="<?= $_GET['maxPrice'] ?>">

                                <?php
                                }
                                ?>
                                <div class="input-group-append">
                                    <button class="btn btn-light btn-sm" style="border: 1px solid #CCC;box-shadow: 0 0 4px rgb(0,0,0,0.2);font-size: 14px;" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--HẾT TÌM KIẾM -->
                </div>
                <div class="row ml-3">
                    <!-- MÓN ĂN -->
                    <?php
                    $food_menu = $food->show_food_menu();
                    if ($food_menu) {
                        while ($row = $food_menu->fetch_assoc()) {
                    ?>
                            <a href="details.php?foodId=<?= $row['foodId'] ?>" style="text-decoration: none;color:black;cursor: unset;">
                                <div class="col-xs-3 item" style="padding:12px;padding-top:unset; height: 210px;margin:10px;width:204px;border-radius:2px; background-color: white;">
                                    <img width="179px" height="140px" src="admin/uploads/<?= $row['image'] ?>" style="border-radius:3px;border: 1px solid #F8F8FF;" alt="">
                                    <div style="border-bottom: #F8F8FF; background-color: #F8F8FF;">
                                        <h5 style="white-space: nowrap; 
                            width: 179px; 
                            overflow: hidden;
                            text-overflow: ellipsis;;text-align: center;margin: 0;margin-top: 4px;margin-bottom: 4px;font-size: 15px;"><?= $row['foodName'] ?></h5>
                                        <h6 style="text-align: center;font-size: 14px;color:#f57224;margin-bottom: 0px;"><?= number_format($row['price'], 0, '', '.') . "₫" ?></h6>
                                        <?php
                                        $show_discount = $config->show_config();
                                        if ($show_discount) {
                                            while ($row2 = $show_discount->fetch_assoc()) {
                                                $discount = (float)$row['price'] * (float)$row2['discount'] / 100;
                                                $discount += (float)$row['price'];
                                                $discount = number_format($discount, 0, '', '.');
                                                $discount = $discount . '₫';

                                                $discount2 = '-' . $row2['discount'] . '%';
                                            }
                                        }
                                        ?>
                                        <p style="font-size: 10px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;text-align: center;opacity: 0.8;">
                                            <?php echo '<del  style="color: #929292;font-size:18px"><span style="font-size:11px;margin-right:2px;margin-left:12px;opacity: 1;">' . $discount . '</span></del> '
                                                . ' ' . $discount2
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    }
                    ?>

                </div>
                <!-- HẾT MÓN ĂN -->

                <!-- PHÂN TRANG -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end mr-5">
                        <li class="page-item">
                            <?php
                            $url_pag = isset($_GET['cate']) ? '&cate=' . $_GET['cate'] : '';
                            $url_sort = isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                            $url_search = isset($_GET['search']) ? '&search=' . $_GET['search'] : '';
                            $url_minPrice = isset($_GET['minPrice']) ? '&minPrice=' . $_GET['minPrice'] : '';
                            $url_maxPrice = isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '';


                            if (!isset($_GET['page']) || $_GET['page'] == 1) {
                                $previous = 1;
                            } else {
                                $previous = $_GET['page'] - 1;
                            }
                            ?>
                            <a class="page-link" href="?page=<?= $previous . $url_pag . $url_sort . $url_search . $url_minPrice . $url_maxPrice ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        $food_all = $food->show_page_menu();
                        if ($food_all != null) {
                            $food_count = mysqli_num_rows($food_all);
                        } else {
                            $food_count = 0;
                        }
                        $food_link = ceil($food_count / 16);
                        $i = 1;
                        for ($i = 1; $i <= $food_link; $i++) {
                            if (!isset($_GET['page'])) {
                                if ($i == 1) {

                        ?>
                                    <li class="page-item active"><a class="page-link" href="?page=<?= $i . $url_pag . $url_sort . $url_search  . $url_minPrice . $url_maxPrice ?>"><?= $i ?></a></li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $i . $url_pag . $url_sort . $url_search  . $url_minPrice . $url_maxPrice ?>"><?= $i ?></a></li>
                                <?php
                                }
                            } else {
                                if ($_GET['page'] == $i) {
                                ?>
                                    <li class="page-item active"><a class="page-link" href="?page=<?= $i . $url_pag . $url_sort . $url_search  . $url_minPrice . $url_maxPrice ?>"><?= $i ?></a></li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $i . $url_pag . $url_sort . $url_search  . $url_minPrice . $url_maxPrice ?>"><?= $i ?></a></li>
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
                                if ($next > $food_link) {
                                    $next = $next - 1;
                                }
                            } else {
                                $next = $_GET['page'] + 1;
                                if ($next > $food_link) {
                                    $next = $next - 1;
                                }
                            }
                            ?>
                            <a class="page-link" href="?page=<?= $next . $url_pag . $url_sort . $url_search  . $url_minPrice . $url_maxPrice ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- HẾT PHÂN TRANG -->
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