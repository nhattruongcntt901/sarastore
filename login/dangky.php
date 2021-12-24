<?php
session_start();
ob_start();
if(isset($_SESSION['id_user']))
{
    echo "<script>window.history.back(-1);</script>";
    die();
}
include("../include/head.php");
?>
<?php
if (isset($_COOKIE['time_left'])) {
    $time_string = $_COOKIE['time_left'];
    $timestamp = strtotime($time_string);
    $year   = date('Y', $timestamp);
    $month  = date('m', $timestamp);
    $month  = $month - 1;
    $day    = date('d', $timestamp);
    $hours  = date('H', $timestamp);
    $minute = date('i', $timestamp);
    $minute = $minute + 2;
    $seconds = date('s', $timestamp);
    $time_left_input = "$year,$month,$day,$hours,$minute,$seconds";
}
?>

<body>
    <!-- head -->
    <div class="head-login">
        <div class="logo-login">
            <a href="../"><img src="../img/logo_sara/ngang-trongsuot.png" alt=""></a>
        </div>
        <span class="title font-shopee2021-regular d-none d-md-block">Đăng Ký</span>
    </div>
    <!-- body -->
    <div class="body-login bg-brown">
        <?php 
        if(isset($_SESSION['dienthongtin']))
        {
            unset($_SESSION['maxacnhan']);
            setcookie("email_success",true,time()-120,"/");
            ?>
                <form class="form-login1" action="insert_user.php" method="post">
                    <h4 class="font-shopee2021-light" style="margin-bottom:30px">Đăng Ký > Xác Nhận Email > Điền Thông Tin</h4>
                    <div class="error"><?php if(isset($_SESSION['error_specialChar'])) { echo $_SESSION['error_specialChar']; unset($_SESSION['error_specialChar']); }?></div>
                    <div class="row-login">
                        <div class="colume-login">
                            <span class="form-title">Email</span>
                            <div class="input-form">
                                <span class="material-icons">local_post_office</span>
                                <input type="email" name='email' value="<?php echo $_SESSION['email_dangki'] ?>" disabled required>
                            </div>
                            <div class="error"></div>
                            <span class="form-title">Họ</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="text" name='ho' placeholder="Họ và tên đệm" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_ho'])) { echo $_SESSION['error_ho']; unset($_SESSION['error_ho']); }?></div>
                            <span class="form-title">Tên</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="text" name='ten' placeholder="Tên của bạn" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_ten'])) { echo $_SESSION['error_ten']; unset($_SESSION['error_ten']); }?></div>
                            <span class="form-title">Giới Tính</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <select class="select-form" name="gioitinh" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                            <div class="error"></div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Tên đăng nhập</span>
                            <div class="input-form">
                                <span class="material-icons">account_circle</span>
                                <input type="text" name='tendangnhap' placeholder="Tên đăng nhập" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_tendangnhap'])) { echo $_SESSION['error_tendangnhap']; unset($_SESSION['error_tendangnhap']); }?></div>
                            <span class="form-title">Mật khẩu</span>
                            <div class="input-form">
                                <span class="material-icons">lock</span>
                                <input type="password" name='matkhau' placeholder="Mật khẩu" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_pass2'])) { echo $_SESSION['error_pass2']; unset($_SESSION['error_pass2']); }?></div>
                            <span class="form-title">Nhập lại mật Khẩu</span>
                            <div class="input-form">
                                <span class="material-icons">lock</span>
                                <input type="password" name='nlmatkhau' placeholder="Nhập lại mật Khẩu" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_pass3'])) { echo $_SESSION['error_pass3']; unset($_SESSION['error_pass3']); }?></div>
                            <span class="form-title">Số điện thoại</span>
                            <div class="input-form">
                                <span class="material-icons">phone</span>
                                <input type="number" name='sdt' placeholder="Số điện thoại" required>
                            </div>
                            <div class="error"><?php if(isset($_SESSION['error_sdt'])) { echo $_SESSION['error_sdt']; unset($_SESSION['error_sdt']); }?></div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class='login-btn font-shopee2021-bold bg-brown'>ĐĂNG KÝ</button>
                    <div style="text-align: center;">
                        <span style="color:gray">Bạn đã có tài khoản? </span><a href="dangnhap.php" style='color:#a58b69'>Đăng nhập</a>
                    </div>
                </form>
            <?php
        }
        else if (!isset($_COOKIE['email_success'])) {
            unset($_SESSION['maxacnhan']);
            unset($_SESSION['email_dangki']); ?>

            <form class="form-login" action="dangky_xacnhan.php" method="post">
                <h4 class="font-shopee2021-light" style="margin-bottom:30px">Đăng Ký</h4>
                <div>
                    <div class="input-form">
                        <span class="material-icons-outlined">person</span>
                        <input type="email" name='email_user' placeholder="Email">
                    </div>
                    <div id="loi-tk" style="color:brown" class="error"><?php if (isset($_SESSION['email_error'])) {
                                                                            echo $_SESSION['email_error'];
                                                                            unset($_SESSION['email_error']);
                                                                        } ?></div>
                </div>
                <button type="submit" class='login-btn font-shopee2021-bold bg-brown'>Tiếp Theo</button>
                <div style="text-align: center;">
                    <span style="color:gray">Bạn đã có tài khoản? </span><a href="dangnhap.php" style='color:#a58b69'>Đăng nhập</a>
                </div>
            </form>

            <?php } else {?>

                <form class="form-login" action="dangky_xacnhan.php" method="post">
                    <h4 class="font-shopee2021-light" style="margin-bottom:30px">Đăng Ký > Xác Nhận Email</h4>
                    <div>
                    <div style="color:brown" class="error"><?php if (isset($_SESSION['maxacnhan_error'])) echo $_SESSION['maxacnhan_error']; ?></div>
                        <div class="input-form">
                            <input type="number" name='maxacnhan' placeholder="Mã Xác Nhận" maxlength="6">
                        </div>
                        <div id="time_left" style="color:brown;font-size:1em" class="error"></div>
                    </div>
                    <button type="submit" class='login-btn font-shopee2021-bold bg-brown'>Tiếp Theo</button>
                    <div style="text-align: center;">
                        <span style="color:gray">Bạn đã có tài khoản? </span><a href="dangnhap.php" style='color:#a58b69'>Đăng nhập</a>
                    </div>
                </form>

            <?php }?>


    </div>
    <!-- footer -->
    <?php include("../include/footer.php"); ?>
    <script src="../js/index.js"></script>
    <script>
        time_left_email(<?php echo $time_left_input; ?>);
    </script>
</body>

</html>