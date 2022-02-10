<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/slider.php';

$class = new slider();

if (!isset($_GET['sliderId']) && $_GET['sliderId'] == NULL) {
    echo "<script>window.location = 'slider.php' </script>";
} else {
    $sliderId = $_GET['sliderId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $desc = $_POST['description'];

    $update_check = $class->update_slider($desc, $_FILES, $sliderId);
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
    <title>Quản lý trình chiếu</title>
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
                    <h1 class="mt-4">Quản lý trình chiếu</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active"><a href="slider.php">Trình chiếu</a></li>
                        <li class="breadcrumb-item active">Sửa trình chiếu</li>
                    </ol>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row ml-5 mr-5 mt-5">
                                <?php
                                if (isset($update_check)) {
                                    echo $update_check;
                                }
                                ?>
                                <?php
                                $get_slider = $class->get_byId($sliderId);
                                if ($get_slider) {
                                    while ($row = $get_slider->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tên trình chiếu</label>
                                            <input type="text" value="<?php echo $row['description'] ?>" name="description" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên trình chiếu">
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-7 mt-5">
                                                    <label for="formFile" class="form-label">Ảnh trình chiếu</label>
                                                    <input class="form-control" type="file" id="formFile" name="image">
                                                </div>
                                                <div class="col-md-5"><img width="100%" style="border: 1px solid #DDDDDD; box-shadow: 0 0 10px rgb(0 0 0 / 20%);border-radius:5px;" src="<?= 'uploads/slider/' . $row['sliderImage'] ?>" alt="Không có ảnh"></div>
                                            </div>
                                        </div>
                                <?php

                                    }
                                }
                                ?>


                                <button type="submit" name="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Sửa</button>
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