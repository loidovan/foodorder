<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/food.php';

header('Content-type: application/vnd-ms-excel');
$filename = "monan.xls";
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
            <th style="border: 1px solid">Tên món ăn</th>
            <th style="border: 1px solid">Danh mục</th>
            <th style="border: 1px solid">Loại</th>
            <th style="border: 1px solid">Giá (vnđ)</th>
            <th style="border: 1px solid">Mô tả</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $show_food = $class->show_food();
        if ($show_food) {
            $i = 1;
            while ($row = $show_food->fetch_assoc()) {
        ?>
                <tr>

                    <td style="border: 1px solid"><?= $i ?></td>
                    <td style="border: 1px solid"><?= $row['foodName'] ?></td>
                    <td style="border: 1px solid"><?= $row['cateName'] ?></td>
                    <td style="border: 1px solid"><?php if ($row['type'] == '1') echo 'Nổi bật';
                                                    else echo 'Thường'; ?></td>
                    <td style="border: 1px solid"><?= number_format($row['price']) ?></td>
                    <td style="border: 1px solid"><?= $row['description'] ?></td>

                </tr>
        <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>