<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '/../lib/database.php');
    include_once ($filepath . '/../helpers/format.php');
?>

<?php
class customer {

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function insert_customer($data)
    {
        $email = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);
        $repassword = $this->fm->validation($data['repassword']);
        $phone = $this->fm->validation($data['phone']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $name = $this->fm->validation($data['name']);

        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $repassword = mysqli_real_escape_string($this->db->link, md5($data['repassword']));
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);

        if (empty($name)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Họ tên không được để trống</div>';
            return $alert;
        } elseif (empty($email)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Email không được để trống</div>';
            return $alert;
        } elseif (empty($password)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Mật khẩu không được để trống</div>';
            return $alert;
        } elseif (empty($repassword)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Nhập lại mật khẩu không được để trống</div>';
            return $alert;
        } elseif (empty($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không hợp lệ</div>';
            return $alert;
        } elseif (empty($address)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ không được để trống</div>';
            return $alert;
        } elseif (empty($city)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tỉnh, thành phố không được để trống</div>';
            return $alert;
        } elseif (strcmp($repassword,$password) != 0) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Mật khẩu và nhập lại mật khẩu không trùng khớp</div>';
            return $alert;
        } elseif ($this->check_same_account($email) == false) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên tài khoản đã được sử dụng</div>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_customer(name,email, password, phone, address, city) VALUES ('$name','$email','$password','$phone','$address','$city')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Đăng ký tài khoản thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Đăng ký tài khoản không thành công</div>';
                return $alert;
            }

        }
    }

    public function update_profile($data, $id, $oldpassword)
    {
        $email = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);
        $oldpassword = $this->fm->validation($oldpassword);
        $phone = $this->fm->validation($data['phone']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $name = $this->fm->validation($data['name']);

        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $newpassword = mysqli_real_escape_string($this->db->link, $data['password']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $oldpassword = mysqli_real_escape_string($this->db->link, md5($oldpassword));
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);

        $check_pass = "SELECT * FROM tbl_customer WHERE id = '$id' AND password = '$oldpassword'";
        $result_check_pass = $this->db->select($check_pass);
        if ($result_check_pass == false) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xác nhận mật khẩu không chính xác</div>';
            return $alert;
        } 

        if (empty($name)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Họ tên không được để trống</div>';
            return $alert;
        } elseif (empty($email)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Email không được để trống</div>';
            return $alert;
        } elseif (empty($password)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Mật khẩu không được để trống</div>';
            return $alert;
        } elseif (empty($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không hợp lệ</div>';
            return $alert;
        } elseif (empty($address)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Địa chỉ không được để trống</div>';
            return $alert;
        } elseif (empty($city)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tỉnh, thành phố không được để trống</div>';
            return $alert;
        } else {
            if (strcmp($newpassword,$oldpassword) != 0) {
                $query = "UPDATE tbl_customer SET name='$name', password='$password', phone='$phone', address='$address', city='$city' WHERE id='$id'";
            } else {
                $query = "UPDATE tbl_customer SET name='$name', phone='$phone', address='$address', city='$city' WHERE id='$id'";
            }
            
            $result = $this->db->update($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa thông tin thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa thông tin không thành công</div>';
                return $alert;
            }

        }
    }

    public function login_customer($data)
    {
        $email = $this->fm->validation($data['loginemail']);
        $password = $this->fm->validation(md5($data['loginpassword']));

        $email = mysqli_real_escape_string($this->db->link, $data['loginemail']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['loginpassword']));

        if (empty($email)) {
            $alert = '<div class="alert alert-danger mt-3 text-center" role="alert">Tên tài khoản email không được để trống</div>';
            return $alert;
        } elseif (empty($password)) {
            $alert = '<div class="alert alert-danger mt-3 text-center" role="alert">Mật khẩu không được để trống</div>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:cart.php');
            } else {
                $alert = '<div class="alert alert-danger mt-3 text-center" role="alert">Sai tài khoản hoặc mật khẩu</div>';
                return $alert;
            }
        }
    }

    private function check_same_account($email) 
    {
        $query = "SELECT * FROM tbl_customer WHERE email = '$email'";
        $result = $this->db->select($query);

        if ($result == false) {
            return true;
        } else {
            return false;
        }
    }

    public function show_profile($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function forget_password($email, $phone)
    {
        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND phone = '$phone'";
        $result = $this->db->select($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $password = $row['password'];
            }

            $alert = '<input type="text" value="MK: '. $password .'" disabled style="background-color: white;border:none;font-size:18px;margin: 0;padding:0;margin-top:30px">' . '<br>' . 'Giải mã <a target="_blank" rel="noopener noreferrer" href="https://md5.gromweb.com/?md5=' . $password . '">https://md5.gromweb.com/</a>';
            return $alert;

        } else {
            $alert = '<input type="text" value="Sai tài khoản hoặc số điện thoại đăng ký" disabled style="background-color: white;border:none;font-size:18px;margin: 0;padding:0px;margin-top:30px;border-radius:5px;color:tomato">';
            return $alert;
        }
    }

    public function show_customers()
    {
        $query = "SELECT * FROM tbl_customer";
        $result = $this->db->select($query);
        return $result;
    }
}


?>
