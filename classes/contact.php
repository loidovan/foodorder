<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class contact {
    
    private $db;
    private $fm;

    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_contact($data)
    {
        $name = $this->fm->validation($data['namecontact']);
        $email = $this->fm->validation($data['emailcontact']);
        $title = $this->fm->validation($data['titlecontact']);
        $content = $this->fm->validation($data['contentcontact']);

        $name = mysqli_real_escape_string($this->db->link, $data['namecontact']);
        $email = mysqli_real_escape_string($this->db->link, $data['emailcontact']);
        $title = mysqli_real_escape_string($this->db->link, $data['titlecontact']);
        $content = mysqli_real_escape_string($this->db->link, $data['contentcontact']);
    
        $query = "INSERT INTO tbl_contact VALUES(null,'$name','$email','$title','$content','0')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Gửi thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Gửi không thành công</div>';
            return $alert;
        }
    }
    
    public function allow_contact($str)
    {
        $query = "UPDATE tbl_contact SET `status` = 1 WHERE id IN ($str)";
        $result = $this->db->update($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xử lý thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xử lý không thành công</div>';
            return $alert;
        }
    }

    public function delete_contact($str)
    {
        $query = "DELETE FROM tbl_contact WHERE id IN ($str)";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa không thành công</div>';
            return $alert;
        }
    }

    public function show_contact()
    {
        $query = "SELECT * FROM tbl_contact ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
}

?>