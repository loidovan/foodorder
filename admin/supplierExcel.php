<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/supplier.php';

header('Content-type: application/vnd-ms-excel');
$filename = "nhacungcap.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new supplier();
?>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid;">STT</th>
            <th style="border: 1px solid;">Tên nhà cung cấp</th>
            <th style="border: 1px solid;">SĐT</th>
            <th style="border: 1px solid;">Email</th>
            <th style="border: 1px solid;">Địa chỉ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $show_supplier = $class->show_supplier();
        if ($show_supplier) {
            $count = 1;
            while ($row = $show_supplier->fetch_assoc()) {
        ?>
                <tr>
                    <td style="border: 1px solid;"><?= $count ?></td>
                    <td style="border: 1px solid;"><?= $row['supplierName'] ?></td>
                    <td style="border: 1px solid;"><?= $row['supplierPhone'] ?></td>
                    <td style="border: 1px solid;"><?= $row['supplierEmail'] ?></td>
                    <td style="border: 1px solid;"><?= $row['supplierAddress'] ?></td>
                </tr>
        <?php
                $count++;
            }
        }
        ?>

    </tbody>
</table>