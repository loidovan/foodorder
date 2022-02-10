<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include_once '../classes/revenue.php';
$revenue = new revenue();

include_once '../classes/food.php';
$food = new food();

include_once '../classes/category.php';
$cate = new category();

include_once '../classes/customer.php';
$customer = new customer();

include_once '../classes/supplier.php';
$supplier = new supplier();
?>

<?php
if (!isset($_POST['del']) && isset($_POST['delete'])) {
    $check_select = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn dòng</div>';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if (isset($_POST['del'])) {
        $count = 0;
        $str = '';
        $delete = $_POST['del'];
        foreach ($delete as $key => $val) {
            if ($count < sizeof($delete) - 1) {
                $str = $str . $val . ',';
            } else {
                $str = $str . $val;
            }
            $count++;
        }

        $delete_check = $revenue->delete_revenue($str);
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
    <title>Quản Lý Lương Sơn Quán</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- CỘT -->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawColChart);

        function drawColChart() {
            var data = google.visualization.arrayToDataTable([
                ['Năm', 'Doanh thu', 'Số đơn hoàn thành'],
                <?php
                $chart_column = $revenue->chart_column_index();
                if ($chart_column) {
                    
                    while ($row = $chart_column->fetch_assoc()) {
                ?>
                        ['<?= $row['year'] ?>', '<?= $row['total'] ?>', '<?= $row['quantityOrder'] ?>'],
                        
                <?php
                    }
                }
                ?>
            ]);

            var options = {
                chart: {
                    //title: 'Thống kê 4 năm gần nhất',
                    subtitle: 'Doanh thu, Số đơn đã bán'
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        //   ĐƯỜNG
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawLineChart);

        function drawLineChart() {
            var data = google.visualization.arrayToDataTable([
                <?php
                $chart_line = $revenue->chart_area_index();
                if ($chart_line) {
                    while ($row = $chart_line->fetch_assoc()) {
                ?>['Quý', 'VNĐ'],
                        ['Q1', <?= $row['q1'] ?>],
                        ['Q2', <?= $row['q2'] ?>],
                        ['Q3', <?= $row['q3'] ?>],
                        ['Q4', <?= $row['q4'] ?>]


                    ]);

            var options = {
                title: 'Doanh Thu',
                hAxis: {
                    title: 'Năm <?= $row['current_year'] ?>',
                    titleTextStyle: {
                        color: '#333'
                    }
                },
                vAxis: {
                    minValue: 0
                },
                width: 520
            };

        <?php
                    }
                }
        ?>

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include './inc/header.php'; ?>

    <div id="layoutSidenav">
        <?php include './inc/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tổng Quan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <?php 
                                    $show_cate = $cate->show_category();
                                    if ($show_cate) {
                                        $count = 0;
                                        while ($row = $show_cate->fetch_assoc()) {
                                            $count++;
                                        }
                                    } 
                                    $show_food = $food->show_food();
                                    if ($show_food) {
                                        $count1 = 0;
                                        while ($row = $show_food->fetch_assoc()) {
                                            $count1++;
                                        }
                                    } 
                                    $show_supplier = $supplier->show_supplier();
                                    if ($show_supplier) {
                                        $count2 = 0;
                                        while ($row = $show_supplier->fetch_assoc()) {
                                            $count2++;
                                        }
                                    } 
                                    $show_customer = $customer->show_customers();
                                    if ($show_customer) {
                                        $count3 = 0;
                                        while ($row = $show_customer->fetch_assoc()) {
                                            $count3++;
                                        }
                                    } 
                                ?>
                                <div class="card-body">Danh Mục Món Ăn <br><i class="fas fa-indent"></i> <?= $count ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="category.php">Xem chi tiết</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Món Ăn <br><i class="fas fa-hotdog"></i> <?= $count1 ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="food.php">Xem chi tiết</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Nhà Cung Cấp <br><i class="fas fa-caravan"></i> <?= $count2 ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="supplier.php">Xem chi tiết</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Thành Viên <br><i class="fas fa-user-friends"></i> <?= $count3 ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white" style="height: 20px;">Số lượng tài khoản khách hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Doanh Thu Theo Quý
                                </div>
                                <div class="card-body p-0">
                                    <div id="chart_div" style="height: 300px;"></div>
                                </div>


                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Thống kê 4 năm gần nhất
                                </div>
                                <div class="card-body p-0">
                                    <div id="columnchart_material" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <?php if (isset($check_select)) {
                            echo $check_select;
                        } elseif (isset($delete_check)) {
                            echo $delete_check;
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng Doanh Thu
                                <button type="submit" name="delete" class="btn btn-primary btn-sm mr-2" onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')" style="float: right;">Xóa món ăn</button>

                            </div>
                            <div class="card-body">

                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên món</th>
                                            <th>SL</th>
                                            <th>Thanh toán</th>
                                            <th>Thời gian nhận</th>
                                            <th>Địa chỉ nhận</th>
                                            <th>Thành tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên món</th>
                                            <th>SL</th>
                                            <th>Thanh toán</th>
                                            <th>Thời gian nhận</th>
                                            <th>Địa chỉ nhận</th>
                                            <th>Thành tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_revenue = $revenue->show_revenue();
                                        if ($show_revenue) {
                                            $i = 1;
                                            $total = 0;
                                            while ($row = $show_revenue->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td style="width:4%;text-align: center;"><?= $i ?></td>
                                                    <td style="text-align: center;"><?= $row['foodName'] ?></td>
                                                    <td style="width:4%;text-align: center;"><?= $row['quantity'] ?></td>
                                                    <td style="width:15%;text-align: center;"><?= $row['paymethod'] ?></td>
                                                    <td style="width:15%;text-align: center;"><?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></td>
                                                    <td style="width:20%"><?= $row['address'] ?></td>
                                                    <td style="width:10%;text-align: right;"><?= number_format($row['price'], 0, '', '.') . 'đ' ?></td>
                                                    <td style="width:5%;text-align: center;">
                                                        <input type="checkbox" name="del[]" value="<?= $row['id'] ?>" style="transform: scale(1.5);-webkit-transform: scale(1.5);cursor:pointer;margin-top: 10px; margin-left: 4px;">
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                                $total += $row['price'];
                                            }
                                        }
                                        ?>

                                    </tbody>
                                    <tr>
                                        <th colspan="8" style="text-align: right;padding-right: 10px;">Tổng tiền: <?= number_format($total, 0, '', '.') . 'đ' ?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <!-- tạo khung bảng, tìm kiếm, dropdown  -->
    <script src="js/format-table.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->

</body>

</html>