<?php  
session_start();
include("../include/chucnang.php");
if(isset($_POST['email_user']))
{
    $email  = $_POST['email_user'];
    $sql    ="SELECT * FROM user WHERE email_user='$email'";
    $ketqua = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $_SESSION['email_error'] = "Email đã có người sử dụng";
        header("location: dangky.php");
        die();
    }
    else
    {
        if(checkEmail($email)==true)
        {
            $_SESSION['maxacnhan'] = rand(100000,999999);
            $_SESSION['email_dangki'] = $email;
            guimail($email,$email,$_SESSION['maxacnhan']);
            setcookie("email_success",true,time()+120,"/");
            setcookie("time_left",layThoigian(),time()+120,"/");
        }
    else
        {
            $_SESSION['email_error'] = "Email không đúng định dạng";
        }
    } 
}
if(isset($_POST['maxacnhan']))
{
    $_SESSION['maxacnhan_error'] = "";
    if($_POST['maxacnhan']==$_SESSION['maxacnhan'])
    {
        $_SESSION['dienthongtin'] = true;
    }
    else
        $_SESSION['maxacnhan_error'] = "Mã xác nhận không đúng";
}
header("location: dangky.php");

?>