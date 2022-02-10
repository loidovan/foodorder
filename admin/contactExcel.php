<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/contact.php';

header('Content-type: application/vnd-ms-excel');
$filename = "lienhe.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new contact();
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
            <th style="border: 1px solid">Chủ đề</th>
            <th style="border: 1px solid">Nội dung</th>
            <th style="border: 1px solid">Thời gian gửi</th>
            <th style="border: 1px solid">Trạng thái</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $show_contact = $class->show_contact();
        if ($show_contact) {
            $i = 1;
            while ($row = $show_contact->fetch_assoc()) {
        ?>
                <tr>

                    <td style="border: 1px solid"><?= $i ?></td>
                    <td style="border: 1px solid"><?= $row['name'] ?></td>
                    <td style="border: 1px solid"><?= $row['email'] ?></td>
                    <td style="border: 1px solid"><?= $row['title'] ?></td>
                    <td style="border: 1px solid"><?= $row['content'] ?></td>
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