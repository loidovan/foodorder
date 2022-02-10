<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/accounts.php';

$class = new accounts();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $adminId = Session::get('adminId');
    $update_check = $class->update_password_account($_POST, $adminId);
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
    <title>Quản lý tài khoản</title>
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
                    <h1 class="mt-4">Quản lý tài khoản</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active">Đổi mật khẩu</li>
                    </ol>
                    <form action="" method="post">
                        <div class="container">
                            <div class="row ml-5 mr-5 mt-5">
                                <?php
                                if (isset($update_check)) {
                                    echo $update_check;
                                }
                                ?>
                                <?php
                                $get_admin = $class->get_by_adminid(Session::get('adminId'));
                                if ($get_admin) {
                                    while ($row = $get_admin->fetch_assoc()) {
                                ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput3">Tên tài khoản</label>
                                            <input disabled type="text" value="<?= $row['adminUser'] ?>" name="username" class="form-control" id="exampleFormControlInput3" placeholder="Nhập tên tài khoản" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Mật khẩu hiện tại</label>
                                            <input type="password" name="oldpassword" class="form-control" id="exampleFormControlInput1" placeholder="Nhập mật khẩu hiện tại" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Mật khẩu mới</label>
                                            <input type="password" name="newpassword" class="form-control" id="exampleFormControlInput2" placeholder="Nhập mật khẩu mới" required>
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