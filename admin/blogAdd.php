<?php
include '../lib/session.php';
Session::checkSession();

include '../classes/blog.php';

$class = new blog();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insert_check = $class->insert_blog($_POST, $_FILES);
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
    <title>Quản lý tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="./js/ckeditor/ckeditor.js"></script>
</head>

<body class="sb-nav-fixed">

    <?php include './inc/header.php' ?>
    <div id="layoutSidenav">
        <?php include './inc/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Quản lý tin tức</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Tổng quan</a></li>
                        <li class="breadcrumb-item active"><a href="blog.php">Tin tức</a></li>
                        <li class="breadcrumb-item active">Thêm tin tức</li>
                    </ol>
                    <form action="blogAdd.php" method="post" enctype="multipart/form-data">
                        <div class="container pt-5 pb-4" style="box-shadow: 0 0 10px rgb(0,0,0,0.2);border-radius: 5px;">
                            <div class="row mr-5 ml-5">
                                <?php
                                if (isset($insert_check) && strcmp($insert_check, '<div class="alert alert-success text-center" role="alert">Thêm bài viết thành công</div>') == 0) {
                                    echo $insert_check;
                                    unset($_POST);
                                } elseif (isset($insert_check)) {
                                    echo $insert_check;
                                }
                                ?>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Tiêu đề bài viết</label>
                                    <input type="text" required value="<?php if (!empty($_POST['title'])) echo $_POST['title'] ?>" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên bài viết">
                                </div>

                                <div class="form-group w-50">
                                    <label for="formFile" class="form-label">Ảnh bài viết</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Mô tả</label>
                                    <textarea name="description" required class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả bài viết"><?php if (!empty($_POST['description'])) echo $_POST['description'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea2">Nội dung bài viết</label>
                                    <textarea name="content" required class="form-control" id="exampleFormControlTextarea2"><?php if (!empty($_POST['content'])) echo $_POST['content'] ?></textarea>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary ml-2 mb-3 mt-2 w-25">Thêm</button>
                            </div>
                        </div>

                        <script>
                            CKEDITOR.replace('content');
                        </script>

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