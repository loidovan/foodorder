<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
require_once '../classes/accounts.php';
$account = new accounts();
?>

<?php

if (Session::get('role') != '0') {
    header('Location: accountsUpdateProfile.php');
}

if (isset($_GET['adminId'])) {
    $adminId =  $_GET['adminId'];
    
    if (isset($adminId)) {
        $del_check = $account->delete_account($adminId);

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
                        <li class="breadcrumb-item active">Tài khoản</li>
                    </ol>
                    <?php
                    if (isset($del_check)) {
                        echo $del_check;
                    } 
                    ?>
                    <form action="" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bảng tài khoản

                    <a href="accountsAdd.php" class="btn btn-primary btn-sm" style="float: right;">Thêm tài khoản</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên người dùng</th>
                                            <th>Email</th>
                                            <th>Tên tài khoản</th>
                                            <th>Mật khẩu</th>

                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên người dùng</th>
                                            <th>Email</th>
                                            <th>Tên tài khoản</th>
                                            <th>Mật khẩu</th>

                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $show_acc = $account->show_account();
                                        if ($show_acc) {
                                            $i = 1;
                                            while ($row = $show_acc->fetch_assoc()) {
                                        ?>
                                                <tr>

                                                    <td style="width:5%"><?= $i ?></td>
                                                    <td style="width:10%"><?= $row['adminName'] ?></td>
                                                    <td style="width:10%"><?= $row['adminEmail'] ?></td>
                                                    <td style="width:10%;"><?= $row['adminUser'] ?></td>
                                                    <td style="width:10%">◉◉◉◉◉◉◉◉</td>

                                                   
                                                    <td style="width:7%;text-align: center;">
                                                        <a href="?adminId=<?= $row['adminId'] ?>" class="btn btn-primary btn-sm">Xóa</a>
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