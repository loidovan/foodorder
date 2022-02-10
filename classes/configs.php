<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class configs
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_config()
    {
        $query = "SELECT * FROM tbl_config";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_config($data, $file)
    {      
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $map = mysqli_real_escape_string($this->db->link, $data['map']);
        $discount = mysqli_real_escape_string($this->db->link, $data['discount']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/logo/" . $unique_image;

        if (empty($name)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên quán không được để trống</div>';
            return $alert;
        } elseif (empty($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không được để trống</div>';
            return $alert;
        } elseif (empty($email)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Email không được để trống</div>';
            return $alert;
        } elseif (empty($address)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ không được để trống</div>';
            return $alert;
        } elseif (empty($map)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ bản đồ không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($discount)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Giảm giá không hợp lệ</div>';
            return $alert;
        } elseif ($file_size > 500000) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Dung lượng ảnh quá lớn</div>';
            return $alert;
        } else {  
            if (in_array($file_ext, $permited) == false && !empty($file_name)) {
                $alert = '<div class="alert alert-danger text-center" role="alert">File ảnh không hợp lệ</div>';
                return $alert;
            }
            
            if (!empty($file_name)) { 
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_config SET name='$name',phone='$phone',email='$email',address='$address',map='$map',discount='$discount',logo='$unique_image' WHERE id='1'";
                $result = $this->db->update($query);
            } else {
               
                $query = "UPDATE tbl_config SET name='$name',phone='$phone',email='$email',address='$address',map='$map',discount='$discount' WHERE id='1'";
                $result = $this->db->update($query);
            }

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa thông tin thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa thông tin không thành công</div>';
                return $alert;
            }
        }
    }

}
?>