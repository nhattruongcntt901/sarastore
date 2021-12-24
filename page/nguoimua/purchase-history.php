<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$lichsu = true;
?>

<body>
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
            <div class="sidebar-item"  onClick="location.href='address'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">home</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Địa Chỉ</span>
                </div>
            </div>
            <div class="sidebar-item"  onClick="location.href='order'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn Hàng</span>
                </div>
            </div>
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='purchase-history'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Lịch Sử Mua Hàng</span>
                </div>
            </div>
        </div>
        <div class="noi-dung" style="background-color: transparent;">
            <div class="title-info">
                <h5>LỊCH SỬ MUA HÀNG</h5>
                <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">lịch sử mua hàng của bạn</span>
                <hr width="95%">
            </div>
            <div class="don-hang">
                <div class="cart-area">
                    <?php
                    $sql      = "SELECT gia_ship, id_donhang, ma_don, a.id_shop, ten_shop,gia_cod FROM donhang a,shop b WHERE a.id_user = $id_user and a.id_shop = b.id_shop and tinhtrang_donhang = 1 ORDER BY id_donhang DESC";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        while($row = mysqli_fetch_assoc($ketqua))
                        {
                            $id_donhang = $row['id_donhang'];
                            $madon      = $row['ma_don'];
                            $id_shop    = $row['id_shop'];
                            $ten_shop   = $row['ten_shop'];
                            $gia_ship   = $row['gia_ship'];
                            $gia_cod    = $row['gia_cod'];
                            $m = 0;
                            $ttvc       = tracuu_don($madon);
                            $sql1 = "SELECT * FROM donhang_sanpham WHERE id_donhang = $id_donhang";
                            $ketqua1   = mysqli_query($ketnoi,$sql1);
                            
                            
                            if(mysqli_num_rows($ketqua1)>0)
                            {
                               while($row1 = mysqli_fetch_assoc($ketqua1))
                                {
                                    $id_sp  = $row1['id_sp'];
                                    $anh_sp = $row1['anh_sp'];
                                    $ten_sp = $row1['ten_sp'];
                                    $soluong= $row1['soluongdat'];
                                    $gia_sp = $row1['dongia'];
                                ?>
                                <?php if($m==0){ ?>
                                    <div class="shop-name" style="margin-top:20px;margin-bottom:0px">
                                        <div class="name-shop1" style='color:#a04444'>
                                            <span class="material-icons">store</span>
                                            <span class="font-shopee2021-bold"><?php echo $ten_shop;?></span>
                                            <span class="font-shopee2021-bold" style='margin-left:auto'>Mã đơn: <?php echo $madon; ?></span>
                                        </div>
                                    </div>
                                    <div style='display:flex;border-bottom:1px solid rgb(0,0,0,0.1);border-top:1px solid rgb(0,0,0,0.1);padding-top:10px;background-color:white'>
                                    <div class="edit-form font-shopee2021-regular" style="width:80%">
                                        <div class="form">
                                            <div class="demuc-form" style="font-size:1.2em">
                                                <span>Họ Và Tên</span>
                                            </div>
                                            <div class="thongtin-form" style='font-size:1.1em'>
                                                <span><?php echo $ttvc[0]->name;?></span>
                                            </div>
                                        </div>
                                        <div class="form">
                                            <div class="demuc-form" style="font-size:1.2em">
                                                <span>Số Điện Thoại</span>
                                            </div>
                                            <div class="thongtin-form" style='font-size:1.1em'>
                                                <span><?php echo $ttvc[0]->phone;?></span>
                                            </div>
                                        </div>
                                        <div class="form">
                                            <div class="demuc-form" style='align-items:flex-start;font-size:1.2em'>
                                                <span>Địa Chỉ</span>
                                            </div>
                                            <div class="thongtin-form" style='flex-wrap:wrap;font-size:1.1em'>
                                                <span style="width:100%"><?php echo $ttvc[0]->street;?></span>
                                                <span style="width:100%"><?php echo $ttvc[0]->ward;?></span>
                                                <span style="width:100%"><?php echo $ttvc[0]->district?></span>
                                                <span style="width:100%"><?php echo $ttvc[0]->city;?></span>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <?php $m=1; } ?>
                                    <div class="cart-product">
                                        <div class="product-img">
                                            <img src="../../img/sanpham/<?php echo $anh_sp; ?>" alt="">
                                        </div>
                                        <div class="right">
                                            <div class="product-name click"
                                                onClick="location.href='san-pham?id_sp=<?php echo $id_sp; ?>'">
                                                <span class="font-shopee2021-regular"><?php echo $ten_sp; ?></span>
                                            </div>
                                            <div class="product-single-price">
                                                <span>₫ <?php echo number_format($gia_sp); ?></span>
                                            </div>
                                            <div class="product-soluong">
                                                <div>
                                                    X<?php echo $soluong; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="van-chuyen" style='margin-bottom:0px;'>
                                <hr width="95%">
                                    <div style="display:flex;align-items:center;gap:10px;margin:10px;color:green" class="font-shopee2021-bold">
                                        <span class="material-icons">local_shipping</span>
                                        <span>NHÀ VẬN CHUYỂN</span>
                                    </div>
                                    <div class="font-shopee2021-light" style='color:#44a072;'>
                                        <span style='margin-right:10px'>Ngày tạo đơn:</span><span class="font-shopee2021-bold"><?php echo $ttvc[4]; ?></span><br>
                                        <span style='margin-right:10px'>Nhà vận chuyển:</span><span class="font-shopee2021-bold"><?php echo $ttvc[2]; ?></span><br>
                                        <span style='margin-right:10px'>Phí vận chuyển:</span><span class="font-shopee2021-bold"> ₫<?php echo number_format($gia_ship); ?></span><br>
                                        <span style='margin-right:10px'>Dự kiến nhận hàng:</span><span class="font-shopee2021-bold"><?php echo $ttvc[3]; ?></span><br>
                                        <span style='margin-right:10px'>Trạng thái:</span><span class="font-shopee2021-bold"><?php echo $ttvc[1]; ?></span>
                                    </div>
                                    <hr width="95%">
                                </div>  
                                <div class="thanh-toan font-shopee2021-bold" style='color:#a56969;'>
                                    <button onclick="location.href='danh-gia?id_donhang=<?php echo $id_donhang; ?>'" class="font-shopee2021-bold bg-brown btn font-white" style='margin-right:auto;font-size:1.5em'>Đánh Giá</button>
                                    <span style='font-size:1.5em'>Tổng tiền: ₫</span><span style='font-size:2em'><?php echo number_format($gia_cod+$gia_ship); ?></span>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

           
                </div>
            </div>
        </div>
    </div>



    <?php
    include("../../include/footer.php");
    ?>
</body>

</html>