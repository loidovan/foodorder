<?php

    $filepath = realpath(dirname(__FILE__));
   
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class accounts
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
   
    public function insert_account($data)
    {
        $name = $this->fm->validation($data['name']);
        $email = $this->fm->validation($data['email']);
        $username = $this->fm->validation($data['username']);
        $password = $this->fm->validation($data['password']);

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
    
        if (!$this->check_same_account($username)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên tài khoản đã được sử dụng</div>';
            return $alert;
        }

        $query = "INSERT INTO tbl_admin VALUES(null,'$name','$email','$username','$password','1')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Thêm tài khoản thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Thêm tài khoản không thành công</div>';
            return $alert;
        }
    }

    public function check_same_account($username)
    {
        $query = "SELECT * FROM tbl_admin WHERE adminUser = '$username'";
        $result = $this->db->select($query);
        if ($result == false) {
            return true;
        } else {
            return false;
        }
    }

    public function update_profile_account($data, $adminId)
    {
        $name = $this->fm->validation($data['name']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
    
        $query = "UPDATE tbl_admin SET adminName = '$name', adminEmail = '$email' WHERE adminId = '$adminId'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Sửa thông tin thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Sửa thông tin không thành công</div>';
            return $alert;
        }
    }

    public function update_password_account($data, $adminId)
    {
        $oldpassword = $this->fm->validation($data['oldpassword']);
        $newpassword = $this->fm->validation($data['newpassword']);

        $oldpassword = mysqli_real_escape_string($this->db->link, md5($data['oldpassword']));
        $newpassword = mysqli_real_escape_string($this->db->link, md5($data['newpassword']));
    
        $check = "SELECT * FROM tbl_admin WHERE adminId = '$adminId'";
        $resultcheck = $this->db->select($check);
        if ($resultcheck) {
            while ($row = $resultcheck->fetch_assoc()) {
                if (strcmp($row['adminPass'],$oldpassword) != 0) {
                    $alert = '<div class="alert alert-danger text-center" role="alert">Mật khẩu cũ không chính xác</div>';
                    return $alert;
                }
            }
        }

        $query = "UPDATE tbl_admin SET adminPass = '$newpassword' WHERE adminId = '$adminId'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Đổi mật khẩu thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Đổi mật khẩu không thành công</div>';
            return $alert;
        }
    }

    public function delete_account($adminId)
    {
        $query = "DELETE FROM tbl_admin WHERE adminId = '$adminId'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa tài khoản thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa tài khoản không thành công</div>';
            return $alert;
        }
    }
   
    public function show_account()
    {
        $query = "SELECT * FROM tbl_admin WHERE `level` != '0' ORDER BY adminId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_by_adminid($adminId)
    {
        $query = "SELECT * FROM tbl_admin WHERE adminId = '$adminId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function forget_password($username, $email)
    {
        $username = mysqli_real_escape_string($this->db->link, $username);
        $email = mysqli_real_escape_string($this->db->link, $email);

        $check = "SELECT * FROM tbl_admin WHERE adminUser = '$username' AND adminEmail = '$email'";
        $resultcheck = $this->db->select($check);
        if ($resultcheck) {
            while ($row = $resultcheck->fetch_assoc()) {
                $password = $row['adminPass'];
            }
            $alert = '<span style="color:white">MK: ' . $password . '</span><br>' . 'Giải mã <a target="_blank" rel="noopener noreferrer" href="https://md5.gromweb.com/?md5=' . $password . '">https://md5.gromweb.com/</a>';
            return $alert;
        } else {
            $alert = '<span style="color:tomato">Tên tài khoản hoặc email đăng ký không chính xác</span>';
            return $alert;
        }

    }
}
?>