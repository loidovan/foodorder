<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/category.php';

$class = new category();
if (!isset($_GET['cateId']) || $_GET['cateId'] == NULL) {
    echo "<script>window.location = 'category.php' </script>";
} else {
    $cateId = $_GET['cateId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cateName = $_POST['cateName'];

    $updateCate = $class->update_category($cateName, $cateId);
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
    <title>Quản lý danh mục</title>
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
                    <h1 class="mt-4">Quản lý danh mục món ăn</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active"><a href="category.php">Danh mục món</a></li>
                        <li class="breadcrumb-item active">Sửa danh mục món</li>
                    </ol>
                    <form action="" method="post">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6 offset-sm-3" style="margin-top: 80px;">
                                    <div class="input-group">
                                        <?php
                                        $get_name = $class->get_byId($cateId);
                                        if ($get_name) {
                                            while ($row = $get_name->fetch_assoc()) {
                                        ?>
                                                <input type="text" name="cateName" value="<?= $row['cateName'] ?>" class="form-control w-50" placeholder="Nhập tên danh mục" aria-label="" aria-describedby="basic-addon1">
                                        <?php
                                            }
                                        }
                                        ?>

                                        <button type="submit" class="btn btn-primary btn-lg"> Sửa danh mục món</button>
                                    </div>

                                    <?php if (isset($updateCate)) {
                                        echo $updateCate;
                                    }
                                    ?>
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