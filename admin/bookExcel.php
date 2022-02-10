<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/book.php';

header('Content-type: application/vnd-ms-excel');
$filename = "dondatban.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new book();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table id="datatablesSimple">
    <thead>
        <tr>
            <th style="border: 1px solid">STT</th>
            <th style="border: 1px solid">Tên khách</th>
            <th style="border: 1px solid">Email</th>
            <th style="border: 1px solid">SĐT</th>
            <th style="border: 1px solid">Ngày</th>
            <th style="border: 1px solid">Giờ</th>
            <th style="border: 1px solid">Số khách</th>
            <th style="border: 1px solid">Yêu cầu khác</th>
            <th style="border: 1px solid">Trạng thái</th>
        </tr>
    </thead>
 
    <tbody>
        <?php
        $show_book = $class->show_book();
        if ($show_book) {
            $i = 1;
            while ($row = $show_book->fetch_assoc()) {
        ?>
                <tr>

                    <td style="border: 1px solid"><?= $i ?></td>
                    <td style="border: 1px solid"><?= $row['name'] ?></td>
                    <td style="border: 1px solid"><?= $row['email'] ?></td>
                    <td style="border: 1px solid"><?= $row['phone'] ?></td>
                    <td style="border: 1px solid"><?= date("d/m/Y", strtotime($row['date'])) ?></td>
                    <td style="border: 1px solid"><?= date("G:i", strtotime($row['time'])) ?></td>
                    <td style="border: 1px solid"><?= $row['quantity'] ?></td>
                    <td style="border: 1px solid"><?= $row['request'] ?></td>
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