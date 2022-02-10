<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class blog
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function show_all_blog_admin()
    {
        $query = "SELECT * FROM tbl_blog ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_blog()
    {
        $sp_tungtrang = 6;
        if (!isset($_GET['page'])) {
            $trang = 1;
        } else {
            $trang = $_GET['page'];
        }

        $tung_trang = ($trang - 1) * $sp_tungtrang;

        $query = "SELECT * FROM tbl_blog ORDER BY id DESC LIMIT $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_blog($data, $file)
    {
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($file_name)) {
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

            $query = "INSERT INTO tbl_blog VALUES (null,'$title','$description','$content','$unique_image',null)";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Thêm bài viết thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Thêm bài viết không thành công</div>';
                return $alert;
            }
        }
    }

    public function update_blog($data, $file, $id)
    {
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

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

                $query = "UPDATE tbl_blog SET title = '$title', description = '$description', content = '$content', image = '$unique_image' WHERE id = '$id'";
                $result = $this->db->update($query);
            } else {
                $query = "UPDATE tbl_blog SET title = '$title', description = '$description', content = '$content' WHERE id = '$id'";
                $result = $this->db->update($query);
            }

            if ($result) {
                $alert = '<div class="alert alert-success text-center" role="alert">Sửa bài viết thành công</div>';
                return $alert;
            } else {
                $alert = '<div class="alert alert-danger text-center" role="alert">Sửa bài viết không thành công</div>';
                return $alert;
            }
        }
    }

    public function delete_blog($id)
    {
        $query = "DELETE FROM tbl_blog WHERE id IN ($id)";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location: blog.php');
        } else {
            header('Location: blog.php');
        }
    }

    public function get_blog_by_id($id)
    {
        $query = "SELECT * FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_blog($keyword)
    {
        $keyword = mysqli_real_escape_string($this->db->link, $keyword);

        $query = "SELECT * FROM tbl_blog WHERE title LIKE '%$keyword%' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_page_blog()
    {
        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
            $keyword = $_GET['keyword'];
            $query = "SELECT * FROM tbl_blog WHERE title LIKE '%$keyword%'";
        } else {
            $query = "SELECT * FROM tbl_blog";
        }
        $result = $this->db->select($query);
        return $result;
    }
}

?>
