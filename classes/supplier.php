<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class supplier
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function insert_supplier($supName,$supPhone,$supEmail,$supAddress)
    {
        //ktra format 
        $supName = $this->fm->validation($supName);
        $supPhone = $this->fm->validation($supPhone);
        $supEmail = $this->fm->validation($supEmail);
        $supAddress = $this->fm->validation($supAddress);
        
        $supName = mysqli_real_escape_string($this->db->link, $supName);
        $supPhone = mysqli_real_escape_string($this->db->link, $supPhone);
        $supEmail = mysqli_real_escape_string($this->db->link, $supEmail);
        $supAddress = mysqli_real_escape_string($this->db->link, $supAddress);

        if (empty($supName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supPhone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supEmail)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Email nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supAddress)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ nhà cung cấp không được để trống</div>';
            return $alert;
        }
        else {
            $query = "INSERT INTO tbl_supplier VALUES (null,'$supName','$supPhone','$supEmail','$supAddress')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Thêm nhà cung cấp thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Thêm nhà cung cấp không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_supplier($supName,$supPhone,$supEmail,$supAddress, $supId)
    {
        //ktra format 
        $supName = $this->fm->validation($supName);
        $supPhone = $this->fm->validation($supPhone);
        $supEmail = $this->fm->validation($supEmail);
        $supAddress = $this->fm->validation($supAddress);
        
        $supName = mysqli_real_escape_string($this->db->link, $supName);
        $supPhone = mysqli_real_escape_string($this->db->link, $supPhone);
        $supEmail = mysqli_real_escape_string($this->db->link, $supEmail);
        $supAddress = mysqli_real_escape_string($this->db->link, $supAddress);

        if (empty($supName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supPhone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supEmail)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Email nhà cung cấp không được để trống</div>';
            return $alert;
        } elseif (empty($supAddress)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ nhà cung cấp không được để trống</div>';
            return $alert;
        }
        else {
            $query = "UPDATE tbl_supplier SET supplierName='$supName',supplierPhone='$supPhone',supplierEmail='$supEmail',supplierAddress='$supAddress' WHERE supplierId='$supId'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa nhà cung cấp thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa nhà cung cấp không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_supplier($str)
    {
        //ktra format 
        $str = $this->fm->validation($str);
        
        $str = mysqli_real_escape_string($this->db->link, $str);
        
        if (empty($str)) {
            echo '<script type="text/javascript">alert("Chưa chọn mục muốn xóa");</script>';
            header('Location: supplier.php');
        } else {
            $query = "DELETE FROM tbl_supplier WHERE supplierId IN ($str)";
            $result = $this->db->delete($query);
            
            if ($result) {
                echo '<script type="text/javascript">alert("Xóa thành công");</script>';
                header('Location: supplier.php');
            } else {
                echo '<script type="text/javascript">alert("Xóa không thành công");</script>';
                header('Location: supplier.php');
            }
        }
    }

    public function show_supplier()
    {
        $query = "SELECT * FROM tbl_supplier ORDER BY supplierId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_byId($supId)
    {
        $query = "SELECT * FROM tbl_supplier WHERE supplierId = '$supId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>