<?php
include_once('db.php');
//Insert data with Ajax
if (isset($_POST['hovaten'])) {
    $hovaten = $_POST['hovaten'];
    $sdt = $_POST['sdt'];
    $result = mysqli_query($Conn, "INSERT INTO human (hoten,sdt) VALUES ('$hovaten','$sdt')");
}
//Select data with Ajax
$output = '';
$sql_select = mysqli_query($Conn, "SELECT * FROM human ORDER BY id DESC");
$output .= '
    <div class="table table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>Họ và tên</td>
                <td>Phone</td>
            </tr>
';
if (mysqli_num_rows($sql_select) > 0) {
    while ($rows = mysqli_fetch_array($sql_select)) {
        $output .= '
            <tr>
                <td contenteditable class="hovaten" data-id1="'. $rows['id'] .'">' . $rows['hoten'] . ' </td>
                <td contenteditable class="sdt" data-id2="'. $rows['id'] .'">' . $rows['sdt'] . '</td>
                <td><button data-id_xoa="'. $rows['id'] .'" class="btn btn-danger del_data">Xoá</button></td>
            </tr>
';
    }
} else {
    $output .= '
            <tr>

                <td colspan="5">Dữ liệu chưa có</td>

            </tr> ';
}
$output .= '
    </table>
</div>
';
echo $output;
//Edit data with Ajax
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $column_name = $_POST['column_name'];
    $result = mysqli_query($Conn, "UPDATE human SET $column_name ='$text' WHERE id = '$id'");
}
//Delete data with Ajax
if(isset($_POST['id_xoa'])) {
    $id = $_POST['id_xoa'];
    
    $result = mysqli_query($Conn,"DELETE FROM human WHERE id='$id' ");
    echo "DELETE FROM human WHERE id='$id' ";
}
?>