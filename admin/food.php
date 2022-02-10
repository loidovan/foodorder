<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/food.php';
$food = new food();
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
</head>

<body class="sb-nav-fixed">
    <?php include './inc/header.php' ?>
    <div id="layoutSidenav">
        <?php include './inc/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Quản lý món ăn</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Món ăn</li>
                    </ol>
                    <form action="foodDelete.php" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng món ăn 
                                <a href="foodAdd.php" class="btn btn-primary btn-sm" style="float: right;">Thêm món ăn</a>
                                <button type="submit" class="btn btn-primary btn-sm mr-2" onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')" style="float: right;">Xóa món ăn</button>
                                <a href="foodExcel.php" class="btn btn-primary btn-sm mr-2" style="float:right">Xuất Excel <i class="fas fa-file-excel"></i></a>
                           
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên món ăn</th>
                                            <th>Danh mục</th>
                                            <th>Loại</th>
                                            <th>Giá (vnđ)</th>
                                            <th>Mô tả</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên món ăn</th>
                                            <th>Danh mục</th>
                                            <th>Loại</th>
                                            <th>Giá (vnđ)</th>
                                            <th>Mô tả</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_food = $food->show_food();
                                        if ($show_food) {
                                            $i = 1;
                                            while ($row = $show_food->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    
                                                    <td style="width:8%;vertical-align: middle;"><?= $i ?></td>
                                                    <td style="width:0%;padding:2px 1px;vertical-align: middle;"><img width="80px" src="<?= 'uploads/' . $row['image'] ?>" alt="Không có ảnh"></td>
                                                    <td style="width:18%;vertical-align: middle;"><?= $row['foodName'] ?></td>
                                                    <td style="width:15%;vertical-align: middle;"><?= $row['cateName'] ?></td>
                                                    <td style="width:8%;vertical-align: middle;"><?php if ($row['type'] == '1') echo 'Nổi bật'; else echo 'Thường'; ?></td>
                                                    <td style="text-align: right;width:12%;vertical-align: middle;"><?= number_format($row['price']) ?></td>
                                                    <td style="width:28%"><?= $row['description'] ?></td>
                                                    <td style="width:5%">
                                                        <a href="foodUpdate.php?foodId=<?= $row['foodId'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                                                    </td>
                                                    <td style="width:4%">
                                                        <input type="checkbox" name="del[]" value="<?= $row['foodId'] ?>" style="transform: scale(1.5);-webkit-transform: scale(1.5);cursor:pointer;margin-top: 10px; margin-left: 4px;">
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