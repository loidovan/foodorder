<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/supplier.php';

if (!isset($_GET['supId']) || $_GET['supId'] == NULL) {
    echo "<script>window.location = 'supplier.php' </script>";
} else {
    $supId = $_GET['supId'];
}

$class = new supplier();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supName = $_POST['supName'];
    $supPhone = $_POST['supPhone'];
    $supEmail = $_POST['supEmail'];
    $supAddress = $_POST['supAddress'];

    $update_check = $class->update_supplier($supName, $supPhone, $supEmail, $supAddress, $supId);
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
                        <li class="breadcrumb-item active"><a href="supplier.php">Nhà cung cấp</a></li>
                        <li class="breadcrumb-item active">Sửa nhà cung cấp</li>
                    </ol>
                    <form action="" method="post">
                        <div class="container">
                            <div class="row ml-5 mr-5">
                                <?php
                                if (isset($update_check)) {
                                    echo $update_check;
                                }
                                ?>
                                <?php
                                $get_Sup = $class->get_byId($supId);
                                if ($get_Sup) {
                                    while ($row = $get_Sup->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tên nhà cung cấp</label>
                                            <input type="text" name="supName" value="<?= $row['supplierName'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên nhà cung cấp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Số điện thoại nhà cung cấp</label>
                                            <input type="text" name="supPhone" value="<?= $row['supplierPhone'] ?>" class="form-control" id="exampleFormControlInput2" placeholder="Nhập số điện thoại nhà cung cấp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput3">Email nhà cung cấp</label>
                                            <input type="email" name="supEmail" value="<?= $row['supplierEmail'] ?>" class="form-control" id="exampleFormControlInput3" placeholder="Nhập email nhà cung cấp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Địa chỉ</label>
                                            <textarea name="supAddress" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập địa chỉ nhà cung cấp"><?= $row['supplierAddress'] ?></textarea>
                                    <?php
                                    }
                                }
                                    ?>

                                        </div> <button type="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Sửa</button>
                            </div>


                        </div>
                </div>
            </main>

        </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <!-- tạo khung bảng, tìm kiếm, dropdown  -->
    <script src="js/format-table.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->

    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>