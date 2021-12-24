<!-- navbar-mb -->
<div class="navbar-mb">
        <div class="nutmenu">
            <span onclick="open_dh()" class="material-icons-outlined" style="font-size: 2em;">menu</span>
        </div>
        <div class="navbar-mb-logo" onClick="location.href='https://localhost/trangchu'">
            <img src="https://localhost/img/logo_sara/ngang-trongsuot-noel.png" alt="">
        </div>
        <div class="timkiem">
            <span class="material-icons-outlined" style="font-size: 2em;" onClick="location.href='https://localhost/mobile/search'">search</span>
        </div>
    </div>
    <div id='menu_dh' class="menu-dieuhuong">
        <div style="width:100%;height:40px">
            <span onclick="close_dh()" style='float:right' class="material-icons font-white">west</span>
        </div>
        <div
            style="display: flex;align-items: center;margin-bottom:20px;background-color: rgba(255, 255, 255, 0.4);border-radius:5px;padding:10px 10px">
            <?php if (!isset($_SESSION['id_user'])) { ?>
            <a class="item" href="https://localhost/login/dangky.php">Đăng Ký</a>
            <b>/</b>
            <a class="item" href="https://localhost/login/dangnhap.php<?php if(isset($_GET['id_sp'])){ $id_sp_page = $_GET['id_sp']; echo "?sanphampage=$id_sp_page"; }?>">Đăng Nhập</a>
            <?php } else { ?>
            <div style="display: flex;align-items: center;" class="click font-white font-shopee2021-bold"
                onClick="location.href='https://localhost/account/profile'">
                <div class="avatar">
                    <img src="https://localhost/img/avatar_user/<?php if($avatar == "default_avatar.jpg"){if ($gioitinh == "Nam") echo "default_avatar_boy";
                                                                        else if($gioitinh=="Nữ"||$gioitinh=="Khác") echo "default_avatar_girl"; ?>.jpg"
                        <?php }else{echo $avatar;} ?>">
                </div>
                <div>
                    <span>Chào, <?php echo $ten; ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
        <a class="font-shopee2021-bold" style="background-color:darkgoldenrod;padding:10px 20px;border-radius:5px"
            href="https://localhost/login/dangxuat.php">Đăng
            Xuất</a>
        <hr width="95%" />
        <?php if(isset($_SESSION['id_user'])){?>
        <div class="font-white">
            <div class="sidebar-item <?php if(isset($sanpham)) echo "item-sidebar-checked"; ?>" onClick="location.href='https://localhost/seller/product-manager'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #4459a0;">account_circle</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Sản Phẩm</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($thongtinshop)) echo "item-sidebar-checked"; ?>" onClick="location.href='https://localhost/seller/info'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">home</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thông Tin Shop</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($donmua)) echo "item-sidebar-checked"; ?>" onClick="location.href='https://localhost/seller/don-mua'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn Mua</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($thongkedoanhso)) echo "item-sidebar-checked"; ?>" onClick="location.href='https://localhost/seller/thong-ke'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thống Kê Doanh Số</span>
                </div>
            </div>
        </div>
        <?php } ?>
        <script>
            var menu_dh = document.getElementById('menu_dh');
            function open_dh(){
                menu_dh.classList.add("open-menu-dieuhuong");
                menu_dh.classList.remove("close-menu-dieuhuong");
            }
            function close_dh(){
                menu_dh.classList.remove("open-menu-dieuhuong");
                menu_dh.classList.add("close-menu-dieuhuong");
            }
        </script>
    </div>
    
    <!-- navbar -->
    <div class="navbar font-white sticky-top">
        <div class="navbar-link font-shopee2021-regular">
            <div class="link-left">
                <a href="<?php if(isset($_SESSION['id_shop'])) { $id_shop = $_SESSION['id_shop']; echo "https://localhost/cua-hang?shop=$id_shop";} else echo "https://localhost/seller/register"?>" class="item">Kênh Người Bán</a>
                <b>|</b>
                <a href="https://localhost/seller/register" class="item">Trở Thành Người Bán Sara</a>
                <b>|</b>
                <a class="item">Kết Nối</a>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
            <div class="link-right" style="display: flex;align-items: center;">
                <?php if (!isset($_SESSION['id_user'])) { ?>
                <a class="item" href="https://localhost/login/dangky.php">Đăng Ký</a>
                <b>|</b>
                <a class="item" href="https://localhost/login/dangnhap.php<?php if(isset($_GET['id_sp'])){ $id_sp_page = $_GET['id_sp']; echo "?sanphampage=$id_sp_page"; }?>">Đăng Nhập</a>
                <?php } else { ?>
                <div style="display: flex;align-items: center;" class="click"
                    onClick="location.href='https://localhost/account/profile'">
                    <div class="avatar">
                        <img src="https://localhost/img/avatar_user/<?php if($avatar == "default_avatar.jpg"){if ($gioitinh == "Nam") echo "default_avatar_boy";
                                                                        else if($gioitinh=="Nữ"||$gioitinh=="Khác") echo "default_avatar_girl"; ?>.jpg"<?php }else{echo $avatar;} ?>">
                    </div>
                    <div>
                        <span>Chào, <?php echo $ten; ?></span>
                    </div>
                </div>
                <a class="item font-shopee2021-bold" style="margin-left:40px" href="https://localhost/login/dangxuat.php">Đăng
                    Xuất</a>
                <?php } ?>
            </div>
        </div>
        <div class="navbar-content">
            <div class="navbar-logo click" onClick="location.href='https://localhost/trangchu'">
                <img src="https://localhost/img/logo_sara/ngang-trongsuot-noel.png" alt="">
            </div>
            <div class="navbar-search">
                <input type="text" placeholder="Tìm kiếm mặt hàng của bạn..."
                    class="search-input font-shopee2021-regular">
                <button class="search-button">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
            <div class="navbar-cart click">
                <span class="material-icons-outlined" style="font-size: 2.5em;"></span>
                <span class="font-shopee2021-light"></span>
            </div>
        </div>
    </div>