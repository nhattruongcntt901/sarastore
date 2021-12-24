<?php 
session_start();
if(isset($_SESSION['id_user']))
{
    echo "<script>window.history.back(-1);</script>";
    die();
}
 include("../include/head.php");
  ?>
<?php 
if(isset($_GET['sanphampage']))
{
    $_SESSION['id_sp_page'] = $_GET['sanphampage'];
}
if(isset($_GET['admin_page']))
{
    $_SESSION['admin_page'] = true;
}
?>
<body>

    <!-- head -->
    <div class="head-login">
        <div class="logo-login">
            <a href="../"><img src="../img/logo_sara/ngang-trongsuot.png" alt=""></a>
        </div>
        <span class="title font-shopee2021-regular d-none d-md-block">Đăng Nhập</span>
    </div>
    <!-- body -->
    <div class="body-login bg-brown">
        <form class="form-login" action="dangnhap_xuly.php" method="post">
            <h4 class="font-shopee2021-light" style="margin-bottom:30px">Đăng Nhập</h4>
            <div class="error"><?php if(isset($_SESSION['login_error'])) { echo $_SESSION['login_error']; unset($_SESSION['login_error']); }?></div>
            <div>
                <div class="input-form">
                    <span class="material-icons-outlined">person</span>
                    <input type="text" name='username' placeholder="Email/Số điện thoại/Tên đăng nhập">
                </div>
                <div id="loi-tk" style="color:brown" class="error"></div>
            </div>
            
            <div>
                <div class="input-form">
                    <span class="material-icons-outlined">lock</span>
                    <input type="password" name='password' placeholder="Mật Khẩu">
                </div>
                <div id='loi-mk' style="color:brown" class="error"></div>
            </div>
            <button type="submit" class='login-btn font-shopee2021-bold bg-brown'>ĐĂNG NHẬP</button>
            <a class="font-shopee2021-light" style='color:blue'>Quên mật khẩu?</a>
            <div style="text-align: center;">
                <span style="color:gray">Bạn mới biết đến Sara? </span><a href="dangky.php" style='color:#a58b69'>Đăng ký</a>
            </div>
        </form>
    </div>
    <!-- footer -->
    <?php include("../include/footer.php"); ?>
</body>
</html>