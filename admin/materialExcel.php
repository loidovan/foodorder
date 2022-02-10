<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/material.php';

header('Content-type: application/vnd-ms-excel');
$filename = "nguyenlieu.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new material();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid;">STT</th>
            <th style="border: 1px solid;">Tên nguyên liệu</th>
            <th style="border: 1px solid;">Nhà cung cấp</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $show_material = $class->show_material();
        if ($show_material) {
            $count = 1;
            while ($row = $show_material->fetch_assoc()) {
        ?>
                <tr>
                    <td style="border: 1px solid;"><?= $count ?></td>
                    <td style="border: 1px solid;"><?= $row['matName'] ?></td>
                    <td style="border: 1px solid;"><?= $row['supplierName'] ?></td>
                </tr>
        <?php
                $count++;
            }
        }
        ?>

    </tbody>
</table>