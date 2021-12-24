<?php
session_start();
$shop_register = true;
include("../../include/ketnoi.php");
if(isset($_SESSION['id_user']))
{
    $id_user = $_SESSION['id_user'];
    $sql      = "SELECT * FROM shop WHERE id_user = $id_user" ;
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)!=0)
    {
        header("location: ../../");
        die();
    }
}
else{
    header("location: ../../login/dangky.php");
}


    include("../../include/chucnang.php");
    include("../../include/head.php");
?>

<body>

    <!-- head -->
    <div class="head-login">
        <div class="logo-login">
            <a href="../"><img src="../img/logo_sara/ngang-trongsuot.png" alt=""></a>
        </div>
        <span class="title font-shopee2021-regular d-none d-md-block">Đăng Ký Trở Thành Người Bán Của SARA</span>
    </div>
    <!-- body -->
    <div class="body-login bg-brown">

        <form class="form-login1" action="add_shop" method="post">
            <h4 class="font-shopee2021-light" style="margin-bottom:30px">Đăng Ký Trở Thành Người Bán</h4>
            <div class="error">
                <?php if(isset($_SESSION['error_specialChar'])) { echo $_SESSION['error_specialChar']; unset($_SESSION['error_specialChar']); }?>
            </div>
            <div class="row-login">
                <!-- Điền Tên Shop -->
                <div class="colume-login">
                    <span class="form-title">Tên Shop</span>
                    <div class="input-form">
                        <span class="material-icons">badge</span>
                        <input type="text" name='tenshop' placeholder="Tên Shop của bạn" required>
                    </div>
                    <div class="error">
                        <?php if(isset($_SESSION['error_tenshop'])) { echo $_SESSION['error_tenshop']; unset($_SESSION['error_tenshop']); }?>
                    </div>
                </div>
                <!-- Chọn danh mục ngành hàng -->
                <div class="colume-login">
                    <span class="form-title">Danh Mục/Ngành Hàng</span>
                    <div class="input-form">
                        <span class="material-icons">badge</span>
                        <select class="select-form" name="nganhhang" required>
                            <option disabled selected hidden>Chọn Danh Mục/Ngành Hàng</option>
                            <?php 
                                $sql      = 'SELECT * FROM danhmuc';
                                $ketqua   = mysqli_query($ketnoi,$sql);
                                if(mysqli_num_rows($ketqua)>0)
                                {
                                    while($row = mysqli_fetch_assoc($ketqua))
                                    {
                                        $ten_dm = $row['ten_dm'];
                                        $id_dm  = $row['id_dm'];
                                        echo "<option value='$id_dm'>$ten_dm</option>";
                                    }
                                }
                            
                            ?>
                        </select>
                    </div>
                    <div class="error"><?php if(isset($_SESSION['error_danhmuc'])) { echo $_SESSION['error_danhmuc']; unset($_SESSION['error_danhmuc']); }?></div>
                </div>
                <!-- Điền Số Điện Thoại -->
                <div class="colume-login">
                    <span class="form-title">Số điện thoại</span>
                    <div class="input-form">
                        <span class="material-icons">phone</span>
                        <input type="number" name='sdt' placeholder="Số điện thoại" required>
                    </div>
                    <div class="error">
                        <?php if(isset($_SESSION['error_sdt'])) { echo $_SESSION['error_sdt']; unset($_SESSION['error_sdt']); }?>
                    </div>
                </div>
                <!-- Chọn Tỉnh -->
                <div class="colume-login">
                    <span class="form-title">Chọn Tỉnh</span>
                    <select class='input-form' name='tinh' id='tinh' onchange="after_choose_province(value)" required>
                        <option disabled selected>Chọn Tỉnh</option>
                        
                    </select>
                    <div class="error">
                        <?php if(isset($_SESSION['error_tinh'])) { echo $_SESSION['error_tinh']; unset($_SESSION['error_tinh']); }?>
                    </div>
                </div>
                <!-- Chọn Huyện -->
                <div class="colume-login">
                    <!-- Chọn Huyện -->
                    <span class="form-title">Chọn Huyện/Thành Phố</span>
                    <select class='input-form' name='huyen' id='huyen' onchange="after_choose_district(value)"  required>
                        <option disabled selected>Chọn Huyện/Thành Phố</option>
                    </select>
                    <div class="error">
                        <?php if(isset($_SESSION['error_huyen'])) { echo $_SESSION['error_huyen']; unset($_SESSION['error_huyen']); }?>
                    </div>
                </div>
                <!-- Chọn Xã -->
                <div class="colume-login">
                    <span class="form-title">Chọn Xã/Phường</span>
                    <select class='input-form' name='xa' id='xa' required>
                        <option disabled selected>Chọn Xã/Phường</option>
                    </select>
                    <div class="error">
                        <?php if(isset($_SESSION['error_xa'])) { echo $_SESSION['error_xa']; unset($_SESSION['error_xa']); }?>
                    </div>
                </div>
                <!-- Điền Số Nhà Tên Đường -->
                <div class="colume-login">
                    <span class="form-title">Số Nhà, Tên Đường</span>
                    <div class="input-form">
                        <input type="text" name='sonha' placeholder="Nhập số nhà tên đường" required>
                    </div>
                    <div class="error">
                        <?php if(isset($_SESSION['error_sonha'])) { echo $_SESSION['error_sonha']; unset($_SESSION['error_sonha']); }?>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class='login-btn font-shopee2021-bold bg-brown'>ĐĂNG KÝ</button>
        </form>
    </div>


    <?php include("../../include/footer.php"); ?>
</body>
<script src="../../js/tinhthanh.js"></script>
<script src="../../js/vitri.js"></script>

</html>