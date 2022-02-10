<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class food
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_food($data, $file)
    {
        $foodName = mysqli_real_escape_string($this->db->link, $data['foodName']);
        $foodIdCategory = mysqli_real_escape_string($this->db->link, $data['foodIdCategory']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($foodName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên món không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($foodIdCategory)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn danh mục món</div>';
            return $alert;
        } elseif (empty($description)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Mô tả món ăn không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($type)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn loại</div>';
            return $alert;
        } elseif (!is_numeric($price)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Giá không hợp lệ</div>';
            return $alert;
        } elseif (empty($file_name)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn ảnh món ăn</div>';
            return $alert;
        } elseif ($file_size > 500000) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Dung lượng ảnh quá lớn</div>';
            return $alert;
        } elseif (in_array($file_ext, $permited) == false) {
            $alert = '<div class="alert alert-danger text-center" role="alert">File ảnh không hợp lệ</div>';
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_food VALUES(null,'$foodName','$foodIdCategory','$description','$type','$price','$unique_image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Thêm món ăn thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Thêm món ăn không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_food($data, $file, $foodId)
    {
        $foodName = mysqli_real_escape_string($this->db->link, $data['foodName']);
        $foodIdCategory = mysqli_real_escape_string($this->db->link, $data['foodIdCategory']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($foodName)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Tên món không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($foodIdCategory)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn danh mục món</div>';
            return $alert;
        } elseif (empty($description)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Mô tả món ăn không được để trống</div>';
            return $alert;
        } elseif (!is_numeric($type)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Bạn chưa chọn loại</div>';
            return $alert;
        } elseif (!is_numeric($price)) {
            $alert = '<div class="alert alert-danger text-center" role="alert">Giá không hợp lệ</div>';
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
                $query = "UPDATE tbl_food SET foodName='$foodName',foodIdCategory='$foodIdCategory',description='$description',type='$type',price='$price',image='$unique_image' WHERE foodId='$foodId'";
                $result = $this->db->update($query);
            } else {

                $query = "UPDATE tbl_food SET foodName='$foodName',foodIdCategory='$foodIdCategory',description='$description',type='$type',price='$price' WHERE foodId='$foodId'";
                $result = $this->db->update($query);
            }

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa món ăn thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa món ăn không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_food($str)
    {
        //ktra format 
        $str = $this->fm->validation($str);

        $str = mysqli_real_escape_string($this->db->link, $str);

        if (empty($str)) {
            header('Location: food.php');
        } else {
            $query = "DELETE FROM tbl_food WHERE foodId IN ($str)";
            $result = $this->db->delete($query);

            if ($result) {
                header('Location: food.php');
            } else {
                header('Location: food.php');
            }
        }
    }

    public function show_food()
    {
        $query = "SELECT * FROM tbl_food,tbl_category WHERE tbl_food.foodIdCategory = tbl_category.cateId ORDER BY tbl_food.foodId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_food_menu()
    {
        $sp_tungtrang = 16;
        if (!isset($_GET['page'])) {
            $trang = 1;
        } else {
            $trang = $_GET['page'];
        }

        if (isset($_GET['cate'])) {
            $cate = 'where foodIdCategory = ' . $_GET['cate'];
        } else {
            $cate = '';
        }

        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'asc') {
                $sort = ' price ASC, ';
            } elseif ($_GET['sort'] == 'desc') {
                $sort = ' price DESC, ';
            } elseif ($_GET['sort'] == 'top') {
                $topsell = "SELECT * FROM tbl_food JOIN (SELECT SUM(r.quantity) AS 'tt',r.foodId AS id FROM tbl_revenue r JOIN tbl_food f ON f.foodId = r.foodId
                GROUP BY r.foodId ORDER BY SUM(r.quantity) DESC) AS a ON a.id = tbl_food.foodId";
                $result = $this->db->select($topsell);
                return $result;
            }
        } else {
            $sort = '';
        }

        if (isset($_GET['search'])) {
            $keywork = $_GET['search'];
            if ($_GET['search'] != '') {
                if (isset($_GET['cate'])) {
                    $search = " AND (foodName LIKE '%" . $keywork . "%'";
                    $search .= " OR price LIKE '%" . $keywork . "%'";
                } elseif (!isset($_GET['cate'])) {
                    $search = " WHERE (foodName LIKE '%" . $keywork . "%'";
                    $search .= " OR price LIKE '%" . $keywork . "%'";
                } else {
                    $search = '';
                }
            } else {
                $search = '';
            }
        } else {
            $search = '';
        }

        if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
            $min = $_GET['minPrice'];
            if ($min == '') {
                $min = ' 0 ';
            } else {
                $min = $_GET['minPrice'];
            }

            if (!isset($_GET['cate']) && !isset($_GET['search'])) {
                $minPrice = ' where price between ' . $min;
            } else {
                if (isset($_GET['search'])) {
                    if ($_GET['search'] == '') {
                        $minPrice = ' and price between ' . $min;
                    } else {
                        $minPrice = ' and price between ' . $min;
                    }
                } else {
                    $minPrice = ' and price between ' . $min;
                }
            }

            $maxPrice = ' and ' . $_GET['maxPrice'];
        } else {
            $minPrice = '';
            $maxPrice = '';
        }

        $tung_trang = ($trang - 1) * $sp_tungtrang;
        if ((!isset($_GET['cate']) && isset($_GET['search']) && isset($_GET['minPrice'])) || (isset($_GET['cate']) && isset($_GET['search']) && isset($_GET['minPrice']))) {
            $query = "SELECT * FROM tbl_food " . $cate . $search . ')' . $minPrice . $maxPrice . " ORDER BY " . $sort . " foodId DESC LIMIT $tung_trang,$sp_tungtrang";
        } elseif (isset($_GET['search']) && !isset($_GET['minPrice'])) {
            $query = "SELECT * FROM tbl_food " . $cate . $search . ')' . $minPrice . $maxPrice . " ORDER BY " . $sort . " foodId DESC LIMIT $tung_trang,$sp_tungtrang";
        } else {
            $query = "SELECT * FROM tbl_food " . $cate . $search . $minPrice . $maxPrice . " ORDER BY " . $sort . " foodId DESC LIMIT $tung_trang,$sp_tungtrang";
        }

        $result = $this->db->select($query);
        return $result;
    }

    public function show_page_menu()
    {
        if (isset($_GET['cate'])) {
            $cate = 'where foodIdCategory = ' . $_GET['cate'];
        } else {
            $cate = '';
        }

        if (isset($_GET['search'])) {
            $keywork = $_GET['search'];
            if ($_GET['search'] != '') {
                if (isset($_GET['cate'])) {
                    $search = " AND foodName LIKE '%" . $keywork . "%'";
                    $search .= " OR price LIKE '%" . $keywork . "%'";
                } elseif (!isset($_GET['cate'])) {
                    $search = " WHERE foodName LIKE '%" . $keywork . "%'";
                    $search .= " OR price LIKE '%" . $keywork . "%'";
                } else {
                    $search = '';
                }
            } else {
                $search = '';
            }
        } else {
            $search = '';
        }

        if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
            $min = $_GET['minPrice'];
            if ($min == '') {
                $min = ' 0 ';
            } else {
                $min = $_GET['minPrice'];
            }

            if (!isset($_GET['cate']) && !isset($_GET['search'])) {
                $minPrice = ' where price between ' . $min;
            } else {
                if (isset($_GET['search'])) {
                    if ($_GET['search'] == '') {
                        $minPrice = ' and price between ' . $min;
                    } else {
                        $minPrice = ' and price between ' . $min;
                    }
                } else {
                    $minPrice = ' and price between ' . $min;
                }
            }

            $maxPrice = ' and ' . $_GET['maxPrice'];
        } else {
            $minPrice = '';
            $maxPrice = '';
        }

        $query = "SELECT * FROM tbl_food " . $cate . $search . $minPrice . $maxPrice;

        $result = $this->db->select($query);
        return $result;
    }

    public function get_byId($foodId)
    {
        $query = "SELECT * FROM tbl_food,tbl_category WHERE tbl_food.foodIdCategory = tbl_category.cateId AND foodId='$foodId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_food_index()
    {
        $query = "SELECT * FROM tbl_food,tbl_category WHERE tbl_food.foodIdCategory = tbl_category.cateId AND type = 1 ORDER BY tbl_food.foodId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_by_category($foodIdCategory, $foodId)
    {
        $query = "SELECT * FROM tbl_food,tbl_category WHERE tbl_food.foodIdCategory = tbl_category.cateId AND foodIdCategory = '$foodIdCategory' AND tbl_food.foodId NOT IN ('$foodId') ORDER BY tbl_food.foodId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function comment_food($customerName, $foodId, $content)
    {
        $customerName = mysqli_real_escape_string($this->db->link, $customerName);
        $foodId = mysqli_real_escape_string($this->db->link, $foodId);
        $content = mysqli_real_escape_string($this->db->link, $content);

        $query = "INSERT INTO tbl_comment VALUES(null,'$customerName','$content','$foodId','0',null,'0')";
        $result = $this->db->insert($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Gửi thành công đang chờ quản trị viên phê duyệt</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Gửi không thành công</div>';
            return $alert;
        }
    }

    public function show_all_comment_admin()
    {
        $query = "SELECT * FROM tbl_comment, tbl_food WHERE tbl_comment.foodId = tbl_food.foodId ORDER BY cmtId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_all_comment_customer($foodId)
    {
        $query = "SELECT * FROM tbl_comment WHERE `status` = 1 AND foodId = '$foodId' ORDER BY cmtId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function allow_comment($str)
    {
        $query = "UPDATE tbl_comment SET `status` = 1 WHERE cmtId IN ($str)";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xét duyệt thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xét duyệt không thành công</div>';
            return $alert;
        }
    }

    public function delete_comment($str)
    {
        $query = "DELETE FROM tbl_comment WHERE cmtId IN ($str)";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<div class="alert alert-success text-center" role="alert">Xóa thành công</div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger text-center" role="alert">Xóa không thành công</div>';
            return $alert;
        }
    }

    public function count_comment($foodId)
    {
        $query = "SELECT COUNT(tbl_comment.cmtId) AS 'sl' FROM tbl_comment WHERE `status` = 1 AND foodId = '$foodId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function like_comment($cmtId)
    {
        $query = "UPDATE tbl_comment SET quantitylike = quantitylike + 1 WHERE cmtId = '$cmtId'";
        $result = $this->db->update($query);
    }
}

?>

