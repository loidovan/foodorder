<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/food.php';
include '../classes/category.php';

$class = new food();
$cboCategory = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insert_check = $class->insert_food($_POST, $_FILES);
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
                        <li class="breadcrumb-item active">Thêm món ăn</li>
                    </ol>
                    <form action="foodAdd.php" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row ml-5 mr-5 mt-5">
                                <?php
                                if (isset($insert_check) && strcmp($insert_check, '<div class="alert alert-success text-center" role="alert">Thêm món ăn thành công</div>') == 0) {
                                    echo $insert_check;
                                    unset($_POST);
                                } elseif (isset($insert_check)) {
                                    echo $insert_check;
                                }
                                ?>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Tên món ăn</label>
                                    <input type="text" value="<?php if (!empty($_POST['foodName'])) echo $_POST['foodName'] ?>" name="foodName" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên món ăn">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Danh mục món</label>
                                    <select name="foodIdCategory" class="form-control" id="exampleFormControlSelect1">
                                        <option value="not">Chọn danh mục món ăn</option>
                                        <?php
                                        $show_cate = $cboCategory->show_category();
                                        if ($show_cate) {
                                            while ($row = $show_cate->fetch_assoc()) {
                                                if (!empty($_POST['foodIdCategory']) && $_POST['foodIdCategory'] == $row['cateId']) {
                                        ?>
                                                    <option value="<?= $row['cateId'] ?>" selected><?= $row['cateName'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $row['cateId'] ?>"><?= $row['cateName'] ?></option>
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
                                        <?php if (!empty($_POST['type']) && $_POST['type'] == 1) { ?>
                                            <option value="1" selected>Nổi bật</option>
                                            <option value="0">Thường</option>
                                        <?php } elseif (!empty($_POST['type']) && $_POST['type'] == 0) { ?>
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
                                    <input type="text" value="<?php if (!empty($_POST['price'])) echo $_POST['price'] ?>" name="price" class="form-control" id="exampleFormControlInput2" placeholder="Nhập giá món ăn">
                                </div>

                                <div class="form-group w-50">
                                    <label for="formFile" class="form-label">Ảnh món ăn</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Mô tả</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả món ăn"><?php if (!empty($_POST['description'])) echo $_POST['description'] ?></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Thêm</button>
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