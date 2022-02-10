<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/material.php';

if (!isset($_GET['matId']) || $_GET['matId'] == NULL) {
    echo "<script>window.location = 'material.php' </script>";
} else {
    $matId = $_GET['matId'];
}

$class = new material();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matName = $_POST['matName'];
    $matIdSupplier = $_POST['matIdSupplier'];

    $update_check = $class->update_material($matName, $matIdSupplier, $matId);
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
    <title>Quản lý nguyên liệu</title>
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
                    <h1 class="mt-4">Quản lý nguyên liệu</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active"><a href="material.php">Nguyên liệu</a></li>
                        <li class="breadcrumb-item active">Sửa nguyên liệu</li>
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
                                $get_mat = $class->get_byId($matId);
                                if ($get_mat) {
                                    while ($row = $get_mat->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tên nguyên liệu</label>
                                            <input type="text" name="matName" value="<?= $row['matName'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên nguyên liệu">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nhà cung cấp</label>
                                            <select name="matIdSupplier" class="form-control" id="exampleFormControlSelect1">
                                                <option value="not">Chọn nhà cung cấp</option>
                                                <?php
                                                $cboSupplier = $class->show_cboSupplier();
                                                if ($cboSupplier) {
                                                    while ($row2 = $cboSupplier->fetch_assoc()) {
                                                        if ($row2['supplierId'] == $row['matIdSupplier']) {
                                                ?>
                                                            <option value="<?= $row2['supplierId'] ?>" selected><?= $row2['supplierName'] ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?= $row2['supplierId'] ?>"><?= $row2['supplierName'] ?></option>

                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <button type="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Sửa</button>
                            </div> 
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