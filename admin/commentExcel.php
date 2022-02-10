<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/food.php';

header('Content-type: application/vnd-ms-excel');
$filename = "binhluan.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new food();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table id="datatablesSimple">
    <thead>
        <tr>
            <th style="border: 1px solid">STT</th>
            <th style="border: 1px solid">Tên món</th>
            <th style="border: 1px solid">Tên khách</th>
            <th style="border: 1px solid">Nội dung</th>
            <th style="border: 1px solid">Lượt thích</th>
            <th style="border: 1px solid">Thời gian bình luận</th>
            <th style="border: 1px solid">Trạng thái</th>

        </tr>
    </thead>

    <tbody>
        <?php
        $show_cmt = $class->show_all_comment_admin();
        if ($show_cmt) {
            $i = 1;
            while ($row = $show_cmt->fetch_assoc()) {
        ?>
                <tr>

                    <td style="border: 1px solid"><?= $i ?></td>
                    <td style="border: 1px solid"><?= $row['foodName'] ?></td>
                    <td style="border: 1px solid"><?= $row['cmtName'] ?></td>
                    <td style="border: 1px solid"><?= $row['cmtContent'] ?></td>
                    <td style="border: 1px solid"><?= $row['quantitylike'] ?></td>
                    <td style="border: 1px solid"><?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></td>

                    <td style="border: 1px solid">
                        <?php
                        if ($row['status'] == 0) {
                            echo '<span style="color:tomato">Chờ xử lý</span>';
                        } elseif ($row['status'] == 1) {
                            echo '<span style="color:#33cc33">Đã xử lý</span>';
                        }
                        ?>
                    </td>

                </tr>
        <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>