<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$address= true;
?>

<body style="font-family:Arial, Helvetica, sans-serif;">
<link rel="stylesheet" href="../../css/font-copy.css">
    <?php include("../../include/navbar.php"); ?>
    <!-- body content -->
    <div class="body-content" style="display: flex;margin-bottom:40px">
        <div class="sidebar">
            <div style='display:flex;align-items:center'>
                <div class="account-img">
                    <img src="../img/avatar_user/<?php if($avatar == "default_avatar.jpg"){
                        if($gioitinh=="Nam")
                            echo "default_avatar_boy.jpg";
                        else
                            echo "default_avatar_girl.jpg";
                    }else echo $avatar;?>" alt="">
                </div>
                <div class="acount-name">
                    <span class="font-shopee2021-bold"><?php echo $ten;?></span>
                </div>
            </div>
            <hr width="90%" style="color: rbg(255,255,255,0.5);">
            <div class="sidebar-item" onClick="location.href='profile'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #4459a0;">account_circle</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Tài Khoản Của Tôi</span>
                </div>
            </div>
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='address'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">home</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Địa Chỉ</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='order'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn Hàng</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='purchase-history'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Lịch Sử Mua Hàng</span>
                </div>
            </div>
        </div>
        <div class="noi-dung">
            <div class="title-info address-title">
                <div class="my-address">
                    <h5>ĐỊA CHỈ CỦA TÔI</h5>
                    <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Thêm các địa chỉ mà bạn muốn chúng tôi gửi
                        đến</span>
                </div>
                <div>
                    <button onclick="open_dialog('add_address')" style='display:flex;align-items:center'
                        class="btn bg-brown font-white"><span class="material-icons">add</span><span>Thêm Địa Chỉ
                            Mới</span></button>
                </div>
            </div>
            <hr width="95%">
            <!-- thông báo cập nhật, xóa -->
            <?php if(isset($_SESSION['thongbao_remove_success'])){ ?>
           <div>
                <div class="font-shopee2021-regular" style='background-color:rgba(255, 0, 0, 0.4);width:auto;display:flex;align-items:center;gap:10px;padding:10px 20px;border-radius:5px'>
                    <span class="material-icons font-white">remove_circle</span>
                    <span style='color:white'>Xóa thành công<?php unset($_SESSION['thongbao_remove_success']);?></span>
                </div>
                <hr width="95%">  
           </div>
            <?php } ?>
            <?php if(isset($_SESSION['thongbao_update_success'])){ ?>
           <div>
                <div class="font-shopee2021-regular" style='background-color:#04522b;width:auto;display:flex;align-items:center;gap:10px;padding:10px 20px;border-radius:5px'>
                    <span class="material-icons font-white">check_circle</span>
                    <span style='color:white'>Chỉnh Sửa thành công<?php unset($_SESSION['thongbao_update_success']);?></span>
                </div>
                <hr width="95%">  
           </div>
            <?php } ?>
            <!-- Danh sách địa chỉ -->
            <?php
                $id_user  = $_SESSION['id_user'];  
                $sql      = "SELECT * FROM diachiuser WHERE id_user = $id_user";
                $ketqua   = mysqli_query($ketnoi,$sql);
                if(mysqli_num_rows($ketqua)>0)
                {
                    while($row = mysqli_fetch_assoc($ketqua))
                    {
                        $name_address = getNameAddress($row['xa'],$row['huyen'],$row['tinh']);
                        $xa = $name_address[0];
                        $huyen = $name_address[1];
                        $tinh = $name_address[2];
                        $id_diachi = $row['id_diachi'];
                    ?>
                    <div style='display:flex;border-bottom:1px solid rgb(0,0,0,0.1);margin-bottom:20px'>
                        <div class="edit-form font-shopee2021-regular" style="width:80%">
                            <div class="form">
                                <div class="demuc-form" style="font-size:1.2em">
                                    <span>Họ Và Tên</span>
                                </div>
                                <div class="thongtin-form" style='font-size:1.1em'>
                                    <span><?php echo $row['tennguoinhan'];?></span>
                                </div>
                            </div>
                            <div class="form">
                                <div class="demuc-form" style="font-size:1.2em">
                                    <span>Số Điện Thoại</span>
                                </div>
                                <div class="thongtin-form" style='font-size:1.1em'>
                                    <span><?php echo $row['sdt'];?></span>
                                </div>
                            </div>
                            <div class="form">
                                <div class="demuc-form" style='align-items:flex-start;font-size:1.2em'>
                                    <span>Địa Chỉ</span>
                                </div>
                                <div class="thongtin-form" style='flex-wrap:wrap;font-size:1.1em'>
                                    <span style="width:100%"><?php echo $row['tenduong'];?></span>
                                    <span style="width:100%"><?php echo $xa;?></span>
                                    <span style="width:100%"><?php echo $huyen;?></span>
                                    <span style="width:100%"><?php echo $tinh;?></span>
                                </div>
                            </div>
                        </div>
                        <div style='display:flex;justify-content:flex-end;align-items:center;width:20%'>
                            <div>
                                <a id="<?php echo $id_diachi; ?>" class='click' onclick="open_address_update(this.id)" style='text-decoration:underline;margin-right:30px;'>Sửa</a>
                                <a href="../../page/nguoimua/chucnang/address_remove.php?id_diachi=<?php echo $id_diachi;?>" style='text-decoration:underline;color:black'>Xóa</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    }
                }
                else{
                    ?>
                    <div style='display:flex;justify-content:center;align-items:center;width:100%;height:60%'>
                        <span class="font-shopee2021-bold">Hình Như Bạn Chưa Có Địa Chỉ Giao Hàng Thì Phải !! ^^</span>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <div id="update_address_data"></div>
    <dialog id='add_address'>
        <div class="dialog">
            <div class="dialog-content">
                <div class="dialog-head">
                    <span class="font-shopee2021-bold" style='color:rgb(0,0,0,0.6)'>
                        <h4 style='font-size:1em'>THÊM ĐỊA CHỈ MỚI</h4>
                    </span>
                    <button onclick="close_dialog('add_address')" style='display:flex;align-items:center'
                        class="btn bg-brown font-white"><span class="material-icons">close</span></button>
                </div>
                <form class="dialog-body" action="add_address" method="post">
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Họ và Tên</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="text" name='hoten' placeholder="Nhập họ tên người nhận..." required>
                            </div>
                            <div class="error">
                                <?php if(isset($_SESSION['error_hoten'])) { echo $_SESSION['error_hoten']; unset($_SESSION['error_hoten']); }?>
                            </div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Số Điện Thoại</span>
                            <div class="input-form">
                                <span class="material-icons">phone</span>
                                <input type="text" name='sdt' placeholder="Nhập số điện thoại người nhận..." required>
                            </div>
                            <div class="error">
                                <?php if(isset($_SESSION['error_sdt'])) { echo $_SESSION['error_sdt']; unset($_SESSION['error_sdt']); }?>
                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
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
                        <div class="colume-login">
                            <!-- Chọn Huyện -->
                            <span class="form-title">Chọn Huyện/Thành Phố</span>
                            <select class='input-form' name='huyen' id='huyen' onchange="after_choose_district(value)" required>
                                <option disabled selected>Chọn Huyện/Thành Phố</option>
                            </select>
                            <div class="error">
                                <?php if(isset($_SESSION['error_huyen'])) { echo $_SESSION['error_huyen']; unset($_SESSION['error_huyen']); }?>
                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Chọn Xã/Phường</span>
                            <select class='input-form' name='xa' id='xa' required>
                                <option disabled selected>Chọn Xã/Phường</option>
                            </select>
                            <div class="error">
                                <?php if(isset($_SESSION['error_xa'])) { echo $_SESSION['error_xa']; unset($_SESSION['error_xa']); }?>
                            </div>
                        </div>
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
                    <div>
                        <button type="submit" name='btn-submit' class='login-btn font-shopee2021-bold bg-brown'>THÊM ĐỊA
                            CHỈ</button>
                    </div>
                </form>
                <div class="dialog-head">

                </div>
            </div>
        </div>
    </dialog>                       

    <script src="../../js/index.js"></script>
    <script src="../../js/tinhthanh.js"></script>
<script>
    function open_address_update(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('update_address_data').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../page/nguoimua/chucnang/address_update.php?id_diachi=' + id, true);
    xhttp.send();
}
</script>
    <?php
    include("../../include/footer.php");
    ?>
</body>

</html>