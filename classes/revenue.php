<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class revenue
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_revenue()
    {
        $query = "SELECT * FROM tbl_revenue ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_revenue($str)
    {
        $query = "DELETE FROM tbl_revenue WHERE id IN ($str)";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa không thành công</div>';
            return $alert;
        }
    }

    public function chart_area_index()
    {
        $query = 'SELECT YEAR(r.datetime) AS current_year, 
        SUM(IF(QUARTER(r.datetime) = 1, r.price, 0)) AS q1, 
        SUM(IF(QUARTER(r.datetime) = 2, r.price, 0)) AS q2, 
        SUM(IF(QUARTER(r.datetime) = 3, r.price, 0)) AS q3, 
        SUM(IF(QUARTER(r.datetime) = 4, r.price, 0)) AS q4 
        FROM `tbl_revenue` AS r 
        GROUP BY current_year DESC LIMIT 1';

        $result = $this->db->select($query);
        return $result;
    }

    public function chart_column_index()
    {
        $query = 'SELECT * FROM 
        (SELECT YEAR(tbl_revenue.datetime) AS year, SUM(price) AS total,COUNT(id) AS quantityOrder
        FROM tbl_revenue
        GROUP BY YEAR(tbl_revenue.datetime)
        ORDER BY YEAR(tbl_revenue.datetime) DESC LIMIT 4) AS `t`
        ORDER BY `t`.`year` ASC';

        $result = $this->db->select($query);
        return $result;
    }

    public function chart_area_details()
    {
        if (isset($_GET['year'])) {
            if ($_GET['year'] != '') {
                $year = ' Having year = ' . $_GET['year'];
            } else {
                $year = '';
            }
        } else {
            $year = '';
        }

        $query = "SELECT YEAR(r.datetime) AS year, 
        SUM(IF(QUARTER(r.datetime) = 1, r.price, 0)) AS q1, 
        SUM(IF(QUARTER(r.datetime) = 2, r.price, 0)) AS q2, 
        SUM(IF(QUARTER(r.datetime) = 3, r.price, 0)) AS q3, 
        SUM(IF(QUARTER(r.datetime) = 4, r.price, 0)) AS q4 
        FROM `tbl_revenue` AS r  
        GROUP BY year " . $year . " ORDER BY year DESC LIMIT 1";
        
        //echo $query;die();
        $result = $this->db->select($query);
        return $result;
    }

    public function show_dropdown_area_chart()
    {
        $query = "SELECT YEAR(r.datetime) AS year, 
        SUM(IF(QUARTER(r.datetime) = 1, r.price, 0)) AS q1, 
        SUM(IF(QUARTER(r.datetime) = 2, r.price, 0)) AS q2, 
        SUM(IF(QUARTER(r.datetime) = 3, r.price, 0)) AS q3, 
        SUM(IF(QUARTER(r.datetime) = 4, r.price, 0)) AS q4 
        FROM `tbl_revenue` AS r  
        GROUP BY year ORDER BY year DESC";
        
        $result = $this->db->select($query);
        return $result;
    }
}


?>
