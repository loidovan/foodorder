<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php

class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $foodId)
    {
        $quantity = $this->fm->validation($quantity);

        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $foodId = mysqli_real_escape_string($this->db->link, $foodId);
        $sId = session_id();

        if (!is_numeric($quantity)) {
            $alert = '<div class="alert alert-danger text-center alert-sm" role="alert">Số lượng không hợp lệ</div>';
            return $alert;
        } elseif ((int)$quantity < 1 || (int)$quantity > 100) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số lượng chỉ trong khoảng 1-100</div>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_food WHERE foodId = '$foodId'";
        $result = $this->db->select($query)->fetch_assoc();

        $check_cart = "SELECT * FROM tbl_cart WHERE foodId = '$foodId' AND sId = '$sId'";
        $result_check = $this->db->select($check_cart);
        if ($result_check) {
            $alert = '<div class="alert alert-info text-center" role="alert">Món đã có trong giỏ hàng</div>';
            return $alert;
        } else {
            $query_insert = "INSERT INTO tbl_cart VALUES (null,'$foodId','$sId','" . $result['foodName'] . "','" . $result['price'] . "',$quantity,'" . $result['image'] . "')";
            $insert_cart = $this->db->insert($query_insert);

            if ($insert_cart) {
                header('Location: cart.php');
            }
        }
    }

    public function update_to_cart($quantity, $cartId)
    {
        $quantity = $this->fm->validation($quantity);

        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $sId = session_id();

        if (!is_numeric($quantity)) {
            $alert = '<div class="alert alert-danger text-center alert-sm" role="alert">Số lượng không hợp lệ</div>';
            return $alert;
        } elseif ((int)$quantity < 1 || (int)$quantity > 100) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số lượng chỉ trong khoảng 1-100</div>';
            return $alert;
        }

        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId='$cartId'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center alert-sm" role="alert">Cập nhật giỏ hàng thành công</div>';
            return $alert;
        }
    }

    public function delete_to_cart($cartId)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        }
    }

    public function get_food_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_data_cart_of_session()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_cart_selected($str)
    {
        $query = "SELECT * FROM tbl_cart WHERE cartId IN ($str)";
        $result = $this->db->select($query);
        Session::set('cart_selected', $query);
        return $result;
    }

    public function insert_order($customerId, $address, $paymentmethod)
    {
        $address = $this->fm->validation($address);
        $paymentmethod = $this->fm->validation($paymentmethod);

        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $paymentmethod = mysqli_real_escape_string($this->db->link, $paymentmethod);


        $cartSelected = $this->db->select(Session::get('cart_selected'));

        if ($cartSelected) {
            while ($row = $cartSelected->fetch_assoc()) {
                $foodId = $row['foodId'];
                $foodName = $row['foodName'];
                $quantity = $row['quantity'];
                $price = $row['price'] * $quantity;
                $image = $row['image'];

                $query = "INSERT INTO tbl_order VALUES(null,'$customerId','$foodId','$foodName','$quantity','$price','$image','$paymentmethod','$address',null, '0')";
                $result = $this->db->insert($query);

                $deleleCart = "DELETE FROM tbl_cart WHERE cartId = ' " . $row['cartId'] . " '";
                $delete = $this->db->delete($deleleCart);
            }
        }
    }

    public function show_orderdetails($customerId) {
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY orderId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_all_orderdetails()
    {
        $query = "SELECT * FROM tbl_order ORDER BY orderId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_status($str, $choose)
    {
        $query = "SELECT `status` FROM tbl_order WHERE orderId IN ($str)";
        $result = $this->db->select($query);

        if ($choose == 'ship') {
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] != 0) {
                        return false;
                    }
                }
            }
        }

        $sessionAdmin = Session::get('adminId');
        $levelAdmin = "SELECT `level` FROM tbl_admin WHERE adminId = '$sessionAdmin'";
        $resultLevel = $this->db->select($levelAdmin);
        if ($resultLevel) {
            while($row = $resultLevel->fetch_assoc()) {
                if ($row['level'] == 0) {
                    return true;
                }
            }            
        }

        if ($choose == 'delete') {
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] != 2) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function delete_order($str)
    {
        $query = "DELETE FROM tbl_order WHERE orderId IN ($str)";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa không thành công</div>';
            return $alert;
        }
    }

    public function ship_order($str)
    {
        $query = "UPDATE tbl_order SET `status` = 1 WHERE orderId IN ($str)";
        $result = $this->db->update($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Chuyển khách thành công. Đơn hàng đang vận chuyển</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Chuyển cho khách không thành công</div>';
            return $alert;
        }
    }

    public function receive_order($orderId)
    {
        $query = "UPDATE tbl_order SET `status` = 2 WHERE orderId = '$orderId'";
        $result = $this->db->update($query);

        $queryGetOrder = "SELECT * FROM tbl_order WHERE orderId = '$orderId'";
        $resultGetOrder = $this->db->select($queryGetOrder);
        if ($resultGetOrder) {
            while ($row = $resultGetOrder->fetch_assoc()) {
                $customerId = $row['customerId'];
                $foodId = $row['foodId'];
                $foodName = $row['foodName'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $image = $row['image'];
                $paymentmethod = $row['paymethod'];
                $address = $row['address'];

                $insertRevenue = "INSERT INTO tbl_revenue VALUES (null,'$customerId','$foodId','$foodName','$quantity','$price','$image','$paymentmethod','$address',null)";
                $resultInsert = $this->db->insert($insertRevenue);

            }
        }

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Nhận hàng thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Nhận hàng không thành công</div>';
            return $alert;
        }
    }

    public function check_role()
    {
        $sessionAdmin = Session::get('adminId');
        $levelAdmin = "SELECT `level` FROM tbl_admin WHERE adminId = '$sessionAdmin'";
        $resultLevel = $this->db->select($levelAdmin);
        if ($resultLevel) {
            while($row = $resultLevel->fetch_assoc()) {
                if ($row['level'] == 0) {
                    return true;
                }
            }            
        }
        return false;
    }
}
?>
