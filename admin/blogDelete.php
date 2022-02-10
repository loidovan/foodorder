<?php
include '../lib/session.php';
Session::checkSession();
include '../classes/blog.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $del = (isset($_POST['del'])) ? $_POST['del'] : '';
    if (isset($_POST['del'])) {
        $str = '';
        $count = 0;
        foreach ($del as $key => $value) {
            if ($count < sizeof($del) - 1) {
                $str = $str . $value . ',';
            } else {
                $str = $str . $value;
            }
            $count++;
        }
    }

    $class = new blog();
    if (empty($str)) {
        header('Location:blog.php');
    } else {
        $delete = $class->delete_blog($str);
    }
    
}
?>