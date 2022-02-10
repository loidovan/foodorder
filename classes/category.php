<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class category
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function insert_category($cateName)
    {
        //ktra format 
        $cateName = $this->fm->validation($cateName);
        
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);

        if (empty($cateName)) {
            $alert = '<div class="alert alert-danger mt-5 text-center" role="alert">Tên danh mục không được để trống</div>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category VALUES (null,'$cateName')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success mt-5 text-center" role="alert">Thêm danh mục món ăn thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger mt-5 text-center" role="alert">Thêm danh mục món ăn không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_category($cateName, $cateId)
    {
        //ktra format 
        $cateName = $this->fm->validation($cateName);
        
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);
        $cateId = mysqli_real_escape_string($this->db->link, $cateId);
        
        if (empty($cateName)) {
            $alert = '<div class="alert alert-danger mt-5 text-center" role="alert">Tên danh mục không được để trống</div>';
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET cateName = '$cateName' WHERE cateId = '$cateId'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = '<div class="alert alert-success mt-5 text-center" role="alert">Sửa danh mục món ăn thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger mt-5 text-center" role="alert">Sửa danh mục món ăn không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_category($str)
    {
        //ktra format 
        $str = $this->fm->validation($str);
        
        $str = mysqli_real_escape_string($this->db->link, $str);
        
        if (empty($str)) {
            echo '<script type="text/javascript">alert("Chưa chọn mục muốn xóa");</script>';
            header('Location: category.php');
        } else {
            $query = "DELETE FROM tbl_category WHERE cateId IN ($str)";
            $result = $this->db->delete($query);
            
            if ($result) {
                echo '<script type="text/javascript">alert("Xóa thành công");</script>';
                header('Location: category.php');
            } else {
                echo '<script type="text/javascript">alert("Xóa không thành công");</script>';
                header('Location: category.php');
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY cateId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_byId($cateId)
    {
        $query = "SELECT cateName FROM tbl_category WHERE cateId = '$cateId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>