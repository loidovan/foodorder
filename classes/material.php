<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class material
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_material($matName, $matIdSupplier)
    {

        $matName = $this->fm->validation($matName);

        $matName = mysqli_real_escape_string($this->db->link, $matName);
        $matIdSupplier = mysqli_real_escape_string($this->db->link, $matIdSupplier);

        if (empty($matName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên nguyên liệu không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($matIdSupplier)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn nhà cung cấp</div>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_material VALUE(null,'$matName','$matIdSupplier')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Thêm nguyên liệu thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger-text-center" role="alert">Thêm nguyên liệu không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_material($matName, $matIdSupplier, $matId)
    {
        $matName = $this->fm->validation($matName);

        $matName = mysqli_real_escape_string($this->db->link, $matName);
        $matIdSupplier = mysqli_real_escape_string($this->db->link, $matIdSupplier);
        $matId = mysqli_real_escape_string($this->db->link, $matId);

        if (empty($matName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên nguyên liệu không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($matIdSupplier)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn nhà cung cấp</div>';
            return $alert;
        } else {
            $query = "UPDATE tbl_material SET matName='$matName',matIdSupplier='$matIdSupplier' WHERE matId='$matId'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa nguyên liệu thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger-text-center" role="alert">Sửa nguyên liệu không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_material($str)
    {
        $str = $this->fm->validation($str);

        $str = mysqli_real_escape_string($this->db->link, $str);

        if (empty($str)) {
            header('Location:material.php');
        } else {
            $query = "DELETE FROM tbl_material WHERE matId IN ($str)";
            $result = $this->db->delete($query);

            if ($result) {
                header('Location:material.php');
            } else {
                header('Location:material.php');
            }
        }
    }

    public function show_material()
    {
        $query = "SELECT * FROM tbl_material, tbl_supplier WHERE tbl_material.matIdSupplier = tbl_supplier.supplierId ORDER BY tbl_material.matId DESC"; 
        $result = $this->db->select($query);
        return $result;
    }

    public function get_byId($matId)
    {
        $query = "SELECT * FROM tbl_material, tbl_supplier WHERE tbl_material.matIdSupplier = tbl_supplier.supplierId AND tbl_material.matId='$matId'"; 
        $result = $this->db->select($query);
        return $result;
    }
 
    public function show_cboSupplier() 
    {
        $query = "SELECT * FROM tbl_supplier";
        $result = $this->db->select($query);
        return $result;
    }
}
?>

