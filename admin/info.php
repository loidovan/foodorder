<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/configs.php';

$class = new configs();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $update_check = $class->update_config($_POST, $_FILES);
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
    <title>Quản lý cấu hình</title>
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
                    <h1 class="mt-4">Quản lý cấu hình</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Cấu hình</li>
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
                                $get_info = $class->show_config();
                                if ($get_info) {
                                    while ($row = $get_info->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 mt-4">
                                                    <img width="100%" style="border: 1px solid #DDDDDD; box-shadow: 0 0 10px rgb(0 0 0 / 20%);border-radius:5px;" src="<?= 'uploads/logo/' . $row['logo'] ?>" alt="Không có ảnh">
                                                    <iframe style="height: 408px;margin-top:10px;border-radius:5px; box-shadow: 0 0 10px rgb(0 0 0 / 20%);" src="<?= $row['map'] ?>" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
                                            </div>

                                                <div class="col-md-9">
                                                    <label for="formFile" class="form-label">Ảnh logo</label>
                                                    <input class="form-control mb-3" type="file" id="formFile" name="image">
                                                    <label for="exampleFormControlInput1">Tên quán / Slogan</label>
                                                    <input type="text" value="<?php echo $row['name'] ?>" name="name" class="form-control mb-3" id="exampleFormControlInput1" placeholder="Nhập tên cấu hình">
                                                    <label for="exampleFormControlInput2">Số điện thoại</label>
                                                    <input type="text" value="<?php echo $row['phone'] ?>" name="phone" class="form-control mb-3" id="exampleFormControlInput2" placeholder="Nhập tên cấu hình">
                                                    <label for="exampleFormControlInput3">Email</label>
                                                    <input type="text" value="<?php echo $row['email'] ?>" name="email" class="form-control mb-3" id="exampleFormControlInput3" placeholder="Nhập tên cấu hình">
                                                    <label for="exampleFormControlInput4">Địa chỉ</label>
                                                    <input type="text" value="<?php echo $row['address'] ?>" name="address" class="form-control mb-3" id="exampleFormControlInput4" placeholder="Nhập tên cấu hình">
                                                    <label for="exampleFormControlInput5">Bản đồ</label>
                                                    <input type="text" value="<?php echo $row['map'] ?>" name="map" class="form-control mb-3" id="exampleFormControlInput5" placeholder="Nhập tên cấu hình">
                                                    <label for="exampleFormControlInput6">Giảm giá (%)</label>
                                                    <input type="text" value="<?php echo $row['discount'] ?>" name="discount" class="form-control mb-3" id="exampleFormControlInput6" placeholder="Nhập tên cấu hình">
                                                    <button type="submit" name="submit" class="btn btn-primary mb-3 mt-3 w-25">Lưu</button>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                        </div>


                                <?php

                                    }
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