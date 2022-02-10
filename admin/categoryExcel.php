<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/category.php';

header('Content-type: application/vnd-ms-excel');
$filename = "danhmucmonan.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new category();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid;">STT</th>
            <th style="border: 1px solid;">Tên danh mục món ăn</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $show_category = $class->show_category();
        if ($show_category) {
            $count = 1;
            while ($row = $show_category->fetch_assoc()) {
        ?>
                <tr>
                    <td style="border: 1px solid;"><?= $count ?></td>
                    <td style="border: 1px solid;"><?= $row['cateName'] ?></td>
                </tr>
        <?php
                $count++;
            }
        }
        ?>

    </tbody>
</table>