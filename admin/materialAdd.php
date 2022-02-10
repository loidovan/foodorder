<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/material.php';

$class = new material();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matName = $_POST['matName'];
    $matIdSupplier = $_POST['matIdSupplier'];

    $insert_check = $class->insert_material($matName, $matIdSupplier);
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
                        <li class="breadcrumb-item active">Thêm nguyên liệu</li>
                    </ol>
                    <form action="materialAdd.php" method="post">
                        <div class="container">
                            <div class="row ml-5 mr-5 mt-5">
                                <?php
                                if (isset($insert_check) && strcmp($insert_check, '<div class="alert alert-success text-center" role="alert">Thêm nguyên liệu thành công</div>') == 0) {
                                    echo $insert_check;
                                    $matName = '';
                                    $matIdSupplier = '';
                                } elseif (isset($insert_check)) {
                                    echo $insert_check;
                                }
                                ?>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Tên nguyên liệu</label>
                                    <input type="text" name="matName" value="<?php if (!empty($matName)) echo $matName ?>" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên nguyên liệu">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nhà cung cấp</label>
                                    <select name="matIdSupplier" class="form-control" id="exampleFormControlSelect1">
                                        <option value="not">Chọn nhà cung cấp</option>
                                        <?php
                                        $cboSupplier = $class->show_cboSupplier();
                                        if ($cboSupplier) {
                                            while ($row = $cboSupplier->fetch_assoc()) {
                                                if (!empty($matIdSupplier) && $matIdSupplier == $row['supplierId']) {
                                        ?>
                                                    <option value="<?= $row['supplierId'] ?>" selected><?= $row['supplierName'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $row['supplierId'] ?>"><?= $row['supplierName'] ?></option>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Thêm</button>
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