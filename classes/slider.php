<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class slider
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    
    public function insert_slider($description, $file)
    {   
        $description = mysqli_real_escape_string($this->db->link, $description);
       
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/slider/" . $unique_image;

        if (empty($file_name)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn ảnh trình chiếu</div>';
            return $alert;
        } elseif ($file_size > 500000) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Dung lượng ảnh quá lớn</div>';
            return $alert;
        } elseif (in_array($file_ext, $permited) == false) {
            $alert = '<div class="alert alert-danger text-center" role="alert">File ảnh không hợp lệ</div>';
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_slider VALUES(null, '$unique_image', '$description')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Thêm trình chiếu thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Thêm trình chiếu không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_slider($description, $file, $sliderId)
    {      
        $description = mysqli_real_escape_string($this->db->link, $description);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/slider/" . $unique_image;

        if ($file_size > 500000) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Dung lượng ảnh quá lớn</div>';
            return $alert;
        } else {  
            if (in_array($file_ext, $permited) == false && !empty($file_name)) {
                $alert = '<div class="alert alert-danger text-center" role="alert">File ảnh không hợp lệ</div>';
                return $alert;
            }
            
            if (!empty($file_name)) { 
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_slider SET description='$description',sliderImage='$unique_image' WHERE sliderId='$sliderId'";
                $result = $this->db->update($query);
            } else {
               
                $query = "UPDATE tbl_slider SET description='$description' WHERE sliderId='$sliderId'";
                $result = $this->db->update($query);
            }

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa trình chiếu thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa trình chiếu không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_slider($str)
    {
        //ktra format 
        $str = $this->fm->validation($str);

        $str = mysqli_real_escape_string($this->db->link, $str);

        if (empty($str)) {
            header('Location: slider.php');
        } else {
            $query = "DELETE FROM tbl_slider WHERE sliderId IN ($str)";
            $result = $this->db->delete($query);

            if ($result) {
                header('Location: slider.php');
            } else {
                header('Location: slider.php');
            }
        }
    }

    public function show_slider()
    {
        $query = "SELECT * FROM tbl_slider";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_byId($sliderId)
    {
        $query = "SELECT * FROM tbl_slider WHERE sliderId='$sliderId'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>