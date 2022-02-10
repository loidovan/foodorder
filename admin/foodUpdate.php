<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/food.php';
include '../classes/category.php';

if (!isset($_GET['foodId']) || $_GET['foodId'] == NULL) {
    echo "<script>window.location = 'food.php' </script>";
} else {
    $foodId = $_GET['foodId'];
}

$class = new food();
$cboCategory = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update = $class->update_food($_POST, $_FILES, $foodId);
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
                        <li class="breadcrumb-item active"><a href="food.php">Món ăn</a></li>
                        <li class="breadcrumb-item active">Sửa món ăn</li>
                    </ol>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row ml-5 mr-5 mt-5">
                                <?php
                                if (isset($update)) {
                                    echo $update;
                                }
                                ?>
                                <?php
                                $get_food = $class->get_byId($foodId);
                                if ($get_food) {
                                    while ($row = $get_food->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tên món ăn</label>
                                            <input type="text" value="<?= $row['foodName'] ?>" name="foodName" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên món ăn">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Danh mục món</label>
                                            <select name="foodIdCategory" class="form-control" id="exampleFormControlSelect1">
                                                <option value="not">Chọn danh mục món ăn</option>
                                                <?php
                                                $show_cate = $cboCategory->show_category();
                                                if ($show_cate) {
                                                    while ($row2 = $show_cate->fetch_assoc()) {
                                                        if ($row2['cateId'] == $row['foodIdCategory']) {
                                                ?>
                                                            <option value="<?= $row2['cateId'] ?>" selected><?= $row2['cateName'] ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?= $row2['cateId'] ?>"><?= $row2['cateName'] ?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Loại</label>
                                            <select name="type" class="form-control" id="exampleFormControlSelect2">
                                                <option value="not">Chọn loại</option>
                                                <?php if ($row['type'] == 1) { ?>
                                                    <option value="1" selected>Nổi bật</option>
                                                    <option value="0">Thường</option>
                                                <?php } elseif ($row['type'] == 0) { ?>
                                                    <option value="1">Nổi bật</option>
                                                    <option value="0" selected>Thường</option>
                                                <?php } else { ?>
                                                    <option value="1">Nổi bật</option>
                                                    <option value="0">Thường</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="exampleFormControlInput2">Giá</label>
                                            <input type="text" value="<?= $row['price'] ?>" name="price" class="form-control" id="exampleFormControlInput2" placeholder="Nhập giá món ăn">
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <label for="formFile" class="form-label">Ảnh món ăn</label>
                                                    <input class="form-control mb-3" type="file" id="formFile" name="image">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Mô tả</label>
                                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả món ăn"><?= $row['description'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <img width="200px" style="border: 1px solid #DDDDDD; box-shadow: 0 0 10px rgb(0 0 0 / 20%);border-radius:5px;" src="<?= 'uploads/' . $row['image'] ?>" alt="Ảnh món ăn">
                                                </div>
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