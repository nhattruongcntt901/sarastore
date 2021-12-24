<?php
session_start();
include("../include/chucnang.php");
if(isset($_POST['username'])&&isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql      = 'SELECT * FROM user';
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            if(($row['email_user']==$username||$row['tendangnhap_user']==$username||$row['sdt_user']==$username)&&$row['matkhau_user']==$password)
            {
                $_SESSION['id_user']    = $row['id_user'];
                $_SESSION['anh_user']   = $row['anh_user'];
                $_SESSION['ho_user']    = $row['ho_user'];
                $_SESSION['ten_user']   = $row['ten_user'];
                $_SESSION['id_loaiuser']= $row['id_loaiuser'];
                if(!isset($_SESSION['cart']))
                {
                    $_SESSION['cart'] = [];
                }
                $allow = true;
                if(isset($_SESSION['id_sp_page']))
                {
                    $id_sp = $_SESSION['id_sp_page'];
                    header("Location: ../san-pham?id_sp=$id_sp");
                }
                else if(isset($_SESSION['admin_page']))
                    header("Location: ../admin");
                else
                    header("Location: ../");
            }
        }
        $allow = false;
    }
    if($allow==false)
    {
        $_SESSION['login_error'] = "Sai tài khoản hoặc mật khẩu";
        echo "<script>window.history.back(-1);</script>";
    }
}
else
{
    header("location: ../");
}
mysqli_close($ketnoi);
?>