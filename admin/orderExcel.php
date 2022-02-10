<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../classes/cart.php';

header('Content-type: application/vnd-ms-excel');
$filename = "dondathang.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

$class = new cart();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table id="datatablesSimple">
    <thead>
        <tr>
            <th style="border: 1px solid">STT</th>
            <th style="border: 1px solid">Tên món</th>
            <th style="border: 1px solid">SL</th>
            <th style="border: 1px solid">Giá (vnđ)</th>
            <th style="border: 1px solid">Thời gian đặt</th>
            <th style="border: 1px solid">Thanh toán</th>
            <th style="border: 1px solid">Địa chỉ nhận hàng</th>
            <th style="border: 1px solid">Trạng thái</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $show_order = $class->show_all_orderdetails();
        if ($show_order) {
            $i = 1;
            while ($row = $show_order->fetch_assoc()) {
        ?>
                <tr>

                    <td style="border: 1px solid"><?= $i ?></td>
                    <td style="border: 1px solid"><?= $row['foodName'] ?></td>
                    <td style="border: 1px solid"><?= $row['quantity'] ?></td>
                    <td style="border: 1px solid"><?= number_format($row['price'], 0, '', '.') . '₫' ?></td>
                    <td style="border: 1px solid"><?= date("d/m/Y  G:i", strtotime($row['datetime'])) ?></td>
                    <td style="border: 1px solid"><?php if (strcmp($row['paymethod'], 'Thanh toán tiền mặt') == 0) echo 'Tiền mặt';
                        else echo 'Điện tử'; ?></td>
                    <td style="border: 1px solid">
                        <?= $row['address'] ?>
                    </td>
                    <td style="border: 1px solid">
                        <?php
                        if ($row['status'] == 0) {
                            echo '<span style="color:tomato">Chờ xử lý</span>';
                        } elseif ($row['status'] == 1) {
                            echo '<span style="color:#0066ff">Đang vận chuyển</span>';
                        } elseif ($row['status'] == 2) {
                            echo '<span style="color:#33cc33">Khách đã nhận</span>';
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