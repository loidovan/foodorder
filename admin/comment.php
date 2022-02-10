<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/food.php';
$food = new food();
?>

<?php
if (!isset($_POST['select']) && (isset($_POST['delete']) || isset($_POST['allow']))) {
    $check_select = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn dòng</div>';
}

if (isset($_POST['select'])) {
    $str = '';
    $count = 0;
    $sel = $_POST['select'];
    foreach ($sel as $key => $val) {
        if ($count < sizeof($sel) - 1) {
            $str = $str . $val . ',';
        } else {
            $str = $str . $val;
        }
        $count++;
    }
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if ($str != '') {
        $del_check = $food->delete_comment($str);
?>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    <?php

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['allow'])) {
    if ($str != '') {
        $allow_check = $food->allow_comment($str);
    ?>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
<?php

    }
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
    <title>Quản lý bình luận</title>
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
                    <h1 class="mt-4">Quản lý bình luận</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Bình luận</li>
                    </ol>
                    <?php
                    if (isset($check_select)) {
                        echo $check_select;
                    } elseif (isset($del_check)) {
                        echo $del_check;
                    } elseif (isset($allow_check)) {
                        echo $allow_check;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng bình luận

                                <button type="submit" name="delete" class="btn btn-primary btn-sm ml-2" onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')" style="float: right;">Xóa bình luận</button>
                                <button type="submit" name="allow" class="btn btn-primary btn-sm" style="float: right;width:104px">Hợp lệ</button>
                                <a href="commentExcel.php" class="btn btn-primary btn-sm mr-2" style="float:right">Xuất Excel <i class="fas fa-file-excel"></i></a>

                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh món ăn</th>
                                            <th>Tên món</th>
                                            <th>Tên khách</th>
                                            <th>Nội dung</th>
                                            <th>Lượt thích</th>
                                            <th>Thời gian bình luận</th>
                                            <th>Trạng thái</th>
                                            <th colspan="2">Chọn</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh món ăn</th>
                                            <th>Tên món</th>
                                            <th>Tên khách</th>
                                            <th>Nội dung</th>
                                            <th>Lượt thích</th>
                                            <th>Thời gian bình luận</th>
                                            <th>Trạng thái</th>
                                            <th colspan="2">Chọn</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_cmt = $food->show_all_comment_admin();
                                        if ($show_cmt) {
                                            $i = 1;
                                            while ($row = $show_cmt->fetch_assoc()) {
                                        ?>
                                                <tr>

                                                    <td style="width:5%"><?= $i ?></td>
                                                    <td style="width:0%;padding:2px 1px;"><img width="80px" src="<?= 'uploads/' . $row['image'] ?>" alt="Không có ảnh"></td>
                                                    <td style="width:16%"><?= $row['foodName'] ?></td>
                                                    <td style="width:10%;text-align: center;"><?= $row['cmtName'] ?></td>
                                                    <td style="width:20%;"><?= $row['cmtContent'] ?></td>
                                                    <td style="width:5%"><?= $row['quantitylike'] ?></td>
                                                    <td style="text-align: center;width:16%"><?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></td>

                                                    <td style="width:10%;text-align: center;">
                                                        <?php
                                                        if ($row['status'] == 0) {
                                                            echo '<span style="color:tomato">Chờ xử lý</span>';
                                                        } elseif ($row['status'] == 1) {
                                                            echo '<span style="color:#33cc33">Đã xử lý</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width:4%;text-align: center;">
                                                        <input type="checkbox" name="select[]" value="<?= $row['cmtId'] ?>" style="transform: scale(1.5);-webkit-transform: scale(1.5);cursor:pointer;margin-top: 10px; margin-left: 4px;">
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