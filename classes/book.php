<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class book
{

    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_book($data)
    {
        $name = $this->fm->validation($data['namebook']);
        $email = $this->fm->validation($data['emailbook']);
        $phone = $this->fm->validation($data['phonebook']);
        $date = $this->fm->validation($data['datebook']);
        $time = $this->fm->validation($data['timebook']);
        $quantity = $this->fm->validation($data['quantitybook']);
        $request = $this->fm->validation($data['requestbook']);

        $name = mysqli_real_escape_string($this->db->link, $data['namebook']);
        $email = mysqli_real_escape_string($this->db->link, $data['emailbook']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phonebook']);
        $date = mysqli_real_escape_string($this->db->link, $data['datebook']);
        $time = mysqli_real_escape_string($this->db->link, $data['timebook']);
        $quantity = mysqli_real_escape_string($this->db->link, $data['quantitybook']);
        $request = mysqli_real_escape_string($this->db->link, $data['requestbook']);

        if (!is_numeric($phone)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số điện thoại không hợp lệ</div>';
            return $alert;
        } elseif ($quantity < 1 || $quantity > 50) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Số khách không hợp lệ (SL từ 1 - 50)</div>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_book VALUES(null,'$name','$email','$phone','$date','$time','$quantity','$request','0')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Đặt bàn thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Đặt bàn không thành công</div>';
                return $alert;
            }
        }
    }

    public function allow_book($str)
    {
        $query = "UPDATE tbl_book SET `status` = 1 WHERE id IN ($str)";
        $result = $this->db->update($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xử lý thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xử lý không thành công</div>';
            return $alert;
        }
    }

    public function delete_book($str)
    {
        $query = "DELETE FROM tbl_book WHERE id IN ($str)";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa không thành công</div>';
            return $alert;
        }
    }

    public function show_book()
    {
        $query = "SELECT * FROM tbl_book ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
}

?>