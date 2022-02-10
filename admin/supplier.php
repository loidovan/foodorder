<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/supplier.php';
$sup = new supplier();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Quản lý nhà cung cấp</title>
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
                    <h1 class="mt-4">Quản lý nhà cung cấp</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Nhà cung cấp</li>
                    </ol>
                    <form action="supplierDelete.php" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng Nhà Cung Cấp
                                <a href="supplierAdd.php" class="btn btn-primary btn-sm mr-2" style="float:right">Thêm nhà cung cấp</a>
                                <button type="submit" class="btn btn-primary btn-sm mr-2" onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')" style="float: right;">Xóa nhà cung cấp</button>
                                <a href="supplierExcel.php" class="btn btn-primary btn-sm mr-2" style="float:right">Xuất Excel <i class="fas fa-file-excel"></i></a>

                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Nhà Cung Cấp</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Nhà Cung Cấp</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_sup = $sup->show_supplier();
                                        if ($show_sup) {
                                            $i = 1;
                                            while ($row = $show_sup->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td style="width:10%"><?= $i ?></td>
                                                    <td><?= $row['supplierName'] ?></td>
                                                    <td><?= $row['supplierPhone'] ?></td>
                                                    <td><?= $row['supplierEmail'] ?></td>
                                                    <td><?= $row['supplierAddress'] ?></td>
                                                    <td style="width:5%">
                                                        <a href="supplierUpdate.php?supId=<?= $row['supplierId'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                                                    </td>
                                                    <td style="width:4%">
                                                        <input type="checkbox" name="del[]" value="<?= $row['supplierId'] ?>" style="transform: scale(1.5);-webkit-transform: scale(1.5);cursor:pointer;margin-top: 10px; margin-left: 4px;">
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