<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/revenue.php';
$revenue = new revenue();

include '../classes/book.php';
$book = new book();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Quản lý món ăn</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                ?>['<?= $row['year'] ?>', '<?= $row['total'] ?>', '<?= $row['quantityOrder'] ?>'],

                <?php
                    }
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Thống kê 4 năm gần nhất',
                    subtitle: 'Doanh thu, Số đơn đã bán',
                    
                },
                colors: ['#BC8F8F','#FFD700']
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
                $chart_line = $revenue->chart_area_details();
                if ($chart_line) {
                    while ($row = $chart_line->fetch_assoc()) {
                ?>['Quý', 'VNĐ'],
                        ['Q1', <?= $row['q1'] ?>],
                        ['Q2', <?= $row['q2'] ?>],
                        ['Q3', <?= $row['q3'] ?>],
                        ['Q4', <?= $row['q4'] ?>]


                    ]);

            var options = {
                title: 'Doanh Thu Theo Quý',
                hAxis: {
                    title: 'Năm <?= $row['year'] ?>',
                    titleTextStyle: {
                        color: '#333'
                    },
                    colors: ['#FF6347', '#66CDAA']
                },
                vAxis: {
                    minValue: 0
                },

            };

        <?php
                    }
                } 
        ?>

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }

        // TRÒN
        google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawPieChart);

      function drawPieChart() {

        var data = google.visualization.arrayToDataTable([
            <?php
                $show_order = $revenue->show_revenue();
                if ($show_order) {
                    $count_order = 0;
                    while ($row = $show_order->fetch_assoc()) {
                        $count_order++;
                    }
                }
                $show_book = $book->show_book();
                if ($show_book) {
                    $count_book = 0;
                    while ($row = $show_book->fetch_assoc()) {
                        $count_book++;
                    }
                }
            ?>
          ['Task', 'Hours per Day'],
          ['Đơn ship',     <?= $count_order ?>],
          ['Đơn đặt bàn',    <?= $count_book ?>],
          
        ]);

        var options = {
          title: 'Chênh lệch số đơn đặt bàn và số đơn đặt ship',
          colors: ['#FF6347', '#66CDAA']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include './inc/header.php' ?>
    <div id="layoutSidenav">
        <?php include './inc/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Thống kê biểu đồ</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Biểu đồ</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle mb-2" style="box-shadow: 0 0 5px rgb(0,0,0,0.3);" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $show_revenue = $revenue->chart_area_index();
                                if ($show_revenue) {
                                    while ($row = $show_revenue->fetch_assoc()) {
                                        if (isset($_GET['year'])) {
                                            echo $_GET['year'];
                                        } else {
                                            echo $row['current_year'];
                                        }
                                    }
                                }
                                ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                $show_revenue = $revenue->show_dropdown_area_chart();
                                if ($show_revenue) {
                                    while ($row = $show_revenue->fetch_assoc()) {
                                ?>
                                        <a class="dropdown-item" href="?year=<?= $row['year'] ?>"><?= $row['year'] ?></a>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div id="chart_div" style="width:100%;height: 360px;"></div>
                        

                    </div>
                    
                    <div class="card mb-4">
                    <div id="columnchart_material" style="width:100%;height: 360px;"></div>
                    </div>

                    <div class="card mb-4">
                    <div id="piechart" style="width:100%;height: 360px;"></div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script type="text/javascript" src="js/map.js"></script>
    <script type="text/javascript" src="js/smooth-scroll.js"></script>
    <script type="text/javascript" src="js/pagination.min.js"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/image-effect.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <!-- tạo khung bảng, tìm kiếm, dropdown  -->
    <script src="js/format-table.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->

    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>