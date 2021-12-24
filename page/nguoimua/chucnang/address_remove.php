<?php
session_start();
include("../../../include/ketnoi.php");
include("../../../include/chucnang.php");
if(isset($_GET['id_diachi']))
{
    $id_user    = $_SESSION['id_user'];
    $id_diachi  = $_GET['id_diachi'];

    $sql      = "SELECT * FROM diachiuser WHERE id_diachi = $id_diachi AND id_user = $id_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        delete_table("diachiuser","id_diachi",$id_diachi);
        $_SESSION['thongbao_remove_success'] = "Xóa Thành Công";
    } 
    else
        return 0;
        
    header("location: ../../../account/address");
}
?>