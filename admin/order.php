<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/cart.php';
$cart = new cart();
?>

<?php
if (!isset($_POST['select']) && (isset($_POST['delete']) || isset($_POST['ship']))) {
    $check_select = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn dòng</div>';
}

if (isset($_POST['select'])) {
    $str = '';
    $count = 0;
    $sel = $_POST['select'];
    foreach ($sel as $key => $val) {
        if ($count < sizeof($sel) - 1) {
            $str = $str . $val . ',';
        } else {
            $str = $str . $val;
        }
        $count++;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if ($str != '') {
        $check = $cart->check_status($str, 'delete');
        if ($check == false) {
            $del_check = '<div class="alert alert-danger text-center" role="alert">Có đơn chưa hoàn thành. Không thể xóa</div>';
        } else {
            $del_check = $cart->delete_order($str);
?>
            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>
        <?php
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ship'])) {
    if ($str != '') {
        $check = $cart->check_status($str, 'ship');
        if ($check == false) {
            $ship_check = '<div class="alert alert-danger text-center" role="alert">Có đơn đã hoàn thành hoặc đang vận chuyển</div>';
        } else {
            $ship_check = $cart->ship_order($str);
        ?>
            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>
<?php
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Quản lý đơn đặt hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <?php include './inc/header.php' ?>
    <div id="layoutSidenav">
        <?php include './inc/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Quản lý đơn đặt hàng</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Đơn đặt hàng</li>
                    </ol>
                    <?php
                    if (isset($check_select)) {
                        echo $check_select;
                    } elseif (isset($del_check)) {
                        echo $del_check;
                    } elseif (isset($ship_check)) {
                        echo $ship_check;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng đơn đặt hàng
                                <?php
                                if ($cart->check_role() == true) {
                                ?>
                                    <button type="submit" name="delete" class="btn btn-primary btn-sm ml-2" onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')" style="float: right;">Xóa đơn đặt hàng</button>
                                <?php
                                }
                                ?>
                                <button type="submit" name="ship" class="btn btn-primary btn-sm" style="float: right;">Chuyển đến khách</button>
                                <a href="orderExcel.php" class="btn btn-primary btn-sm mr-2" style="float:right">Xuất Excel <i class="fas fa-file-excel"></i></a>

                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên món</th>
                                            <th>SL</th>
                                            <th>Giá (vnđ)</th>
                                            <th>Thời gian đặt</th>
                                            <th>Thanh toán</th>
                                            <th>Địa chỉ nhận hàng</th>
                                            <th>Trạng thái</th>
                                            <th colspan="2">Chọn</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên món</th>
                                            <th>SL</th>
                                            <th>Giá (vnđ)</th>
                                            <th>Thời gian đặt</th>
                                            <th>Thanh toán</th>
                                            <th>Địa chỉ nhận hàng</th>
                                            <th>Trạng thái</th>
                                            <th colspan="2">Chọn</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_order = $cart->show_all_orderdetails();
                                        if ($show_order) {
                                            $i = 1;
                                            while ($row = $show_order->fetch_assoc()) {
                                        ?>
                                                <tr>

                                                    <td style="width:5%"><?= $i ?></td>
                                                    <td style="width:0%;padding:2px 1px;"><img width="80px" src="<?= 'uploads/' . $row['image'] ?>" alt="Không có ảnh"></td>
                                                    <td style="width:16%"><?= $row['foodName'] ?></td>
                                                    <td style="width:6%;text-align: center;"><?= $row['quantity'] ?></td>
                                                    <td style="width:10%;text-align: right;"><?= number_format($row['price'], 0, '', '.') . '₫' ?></td>
                                                    <td style="text-align: center;width:16%"><?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></td>
                                                    <td><?php if (strcmp($row['paymethod'], 'Thanh toán tiền mặt') == 0) echo 'Tiền mặt';
                                                        else echo 'Điện tử'; ?></td>
                                                    <td style="width:20%">
                                                        <?= $row['address'] ?>
                                                    </td>
                                                    <td style="width:10%;text-align: center;">
                                                        <?php
                                                        if ($row['status'] == 0) {
                                                            echo '<span style="color:tomato">Chờ xử lý</span>';
                                                        } elseif ($row['status'] == 1) {
                                                            echo '<span style="color:#0066ff">Đang vận chuyển</span>';
                                                        } elseif ($row['status'] == 2) {
                                                            echo '<span style="color:#33cc33">Khách đã nhận</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width:4%;text-align: center;">
                                                        <input type="checkbox" name="select[]" value="<?= $row['orderId'] ?>" style="transform: scale(1.5);-webkit-transform: scale(1.5);cursor:pointer;margin-top: 10px; margin-left: 4px;">
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                </form>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <!-- tạo khung bảng, tìm kiếm, dropdown  -->
    <script src="js/format-table.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->

    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>