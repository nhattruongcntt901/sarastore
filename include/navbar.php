<!-- navbar-mb -->
<?php $tenmien = "http://localhost"; ?>
<div class="navbar-mb">
        <div class="nutmenu">
            <span onclick="open_dh()" class="material-icons-outlined click" style="font-size: 2em;">menu</span>
        </div>
        <div class="navbar-mb-logo" onClick="location.href='<?php echo $tenmien; ?>/trangchu'" style="margin-left:70px">
            <img src="<?php echo $tenmien; ?>/img/logo_sara/ngang-trongsuot-noel.png" alt="">
        </div>
        <div class="timkiem" style="display: flex;">
            <div class="navbar-cart click">
                <span class="material-icons-outlined" onClick="location.href='<?php echo $tenmien; ?>/cart'" style="font-size: 2.5em;">shopping_cart</span>
                <span name='cart' class="cart-soluong font-shopee2021-light">
                    <?php
                     if(isset($_SESSION['cart']))
                     {
                         echo count($_SESSION['cart']);
                     }
                     else
                     {
                        echo 0;
                     }
                    ?>
                </span>
            </div>
            <div style="margin-left: 40px;">
                <span class="material-icons-outlined" style="font-size: 2em;" onClick="location.href='<?php echo $tenmien; ?>/search/mobile/search.php'">search</span>
            </div>
            
        </div>
    </div>
    <div id='menu_dh' class="menu-dieuhuong">
        <div style="width:100%;height:40px">
            <span onclick="close_dh()" style='float:right' class="material-icons font-white click">west</span>
        </div>
        <div 
            style="display: flex;align-items: center;margin-bottom:20px;background-color: rgba(255, 255, 255, 0.4);border-radius:5px;padding:10px 10px">
            <?php if (!isset($_SESSION['id_user'])) { ?>
            <a class="item" href="<?php echo $tenmien; ?>/login/dangky.php">Đăng Ký</a>
            <b>/</b>
            <a class="item" href="<?php echo $tenmien; ?>/login/dangnhap.php<?php if(isset($_GET['id_sp'])){ $id_sp_page = $_GET['id_sp']; echo "?sanphampage=$id_sp_page"; }?>">Đăng Nhập</a>
            <?php } else { ?>
            <div style="display: flex;align-items: center;" class="click font-white font-shopee2021-bold"
                onClick="location.href='<?php echo $tenmien; ?>/account/profile'">
                <div class="avatar">
                    <img src="<?php echo $tenmien; ?>/img/avatar_user/<?php if($avatar == "default_avatar.jpg"){if ($gioitinh == "Nam") echo "default_avatar_boy";
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
            href="<?php echo $tenmien; ?>/login/dangxuat.php">Đăng
            Xuất</a>
        <hr width="95%" />
        <?php if(isset($_SESSION['id_user'])){?>
        <div class="font-white">
            <div class="sidebar-item <?php if(isset($account)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/account/profile'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #4459a0;">account_circle</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Tài Khoản Của Tôi</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($address)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/account/address'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">home</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Địa Chỉ</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($order)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/account/order'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn Hàng</span>
                </div>
            </div>
            <div class="sidebar-item <?php if(isset($lichsu)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/account/purchase-history'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Lịch Sử Mua Hàng</span>
                </div>
            </div>
            <?php 
                if(isset($_SESSION['id_shop'])){
            ?>
            <div class="sidebar-item <?php if(isset($shop)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/cua-hang?shop=<?php echo $_SESSION['id_shop'];  ?>'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #9844a0;">store</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Shop Của Tôi</span>
                </div>
            </div>
            <?php }else{ ?>
                <div class="sidebar-item <?php if(isset($shop_register)) echo "item-sidebar-checked"; ?>" onClick="location.href='<?php echo $tenmien; ?>/seller/register'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #9844a0;">store</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Trở Thành Người Bán</span>
                </div>
            </div>
                <?php } ?>
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
    <?php 
    if(isset($_SESSION['id_user']))
    {
        $sql      = "SELECT count(dadoc) as soluong FROM chat WHERE (user_to = $id_user or user_from = $id_user) and dadoc = 0";
        $ketqua   = mysqli_query($ketnoi,$sql);
        if(mysqli_num_rows($ketqua)>0)
        {
            $row = mysqli_fetch_assoc($ketqua);
            $soluong_tn = $row['soluong'];
        }
        $sql      = "SELECT * FROM chat WHERE user_to = $id_user AND id in (SELECT MAX(id) FROM chat WHERE user_to = $id_user GROUP BY user_from) ORDER BY id DESC";
        $ketqua   = mysqli_query($ketnoi,$sql);
        if(mysqli_num_rows($ketqua)>0)
        {
            $row = mysqli_fetch_assoc($ketqua);
                $user_from = $row['user_from'];
    
        }
    }

    ?>
    <!-- navbar -->
    <div class="navbar font-white">
        <div class="navbar-link font-shopee2021-regular">
            <div class="link-left">
                <a href="<?php if(isset($_SESSION['id_shop'])) { $id_shop = $_SESSION['id_shop']; echo "$tenmien/cua-hang?shop=$id_shop";} else echo "$tenmien/seller/register"?>" class="item">Kênh Người Bán</a>
                <b>|</b>
                <a href="<?php echo $tenmien; ?>/seller/register" class="item">Trở Thành Người Bán Sara</a>
                <b>|</b>
                <a class="item">Kết Nối</a>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
            <div class="link-right" style="display: flex;align-items: center;">
            <?php if(isset($soluong_tn)){ ?>
                <div class="click" onClick="location.href='http://localhost/chat/chat_page.php?chat_user=<?php echo $user_from; ?>'" style="display:flex;gap:15px;margin-right:30px;align-items:center">
                    <span style="height: 20px;">
                        <span class="material-icons-outlined" style='font-size:2em'>chat_bubble_outline</span>
                        <span id='new_mess' class="tinnhannew font-shopee2021-light"><?php echo $soluong_tn; ?></span>
                    </span>
                    <span>Tin Nhắn</span>
                </div>
                <?php } ?>

                <?php if (!isset($_SESSION['id_user'])) { ?>
                <a class="item" href="<?php echo $tenmien; ?>/login/dangky.php">Đăng Ký</a>
                <b>|</b>
                <a class="item" href="<?php echo $tenmien; ?>/login/dangnhap.php<?php if(isset($_GET['id_sp'])){ $id_sp_page = $_GET['id_sp']; echo "?sanphampage=$id_sp_page"; }?>">Đăng Nhập</a>
                <?php } else { ?>
                <div style="display: flex;align-items: center;" class="click"
                    onClick="location.href='<?php echo $tenmien; ?>/account/profile'">
                    <div class="avatar">
                        <img src="<?php echo $tenmien; ?>/img/avatar_user/<?php if($avatar == "default_avatar.jpg"){if ($gioitinh == "Nam") echo "default_avatar_boy";
                                                                        else if($gioitinh=="Nữ"||$gioitinh=="Khác") echo "default_avatar_girl"; ?>.jpg"<?php }else{echo $avatar;} ?>">
                    </div>
                    <div>
                        <span>Chào, <?php echo $ten; ?></span>
                    </div>
                </div>
                <a class="item font-shopee2021-bold" style="margin-left:40px" href="<?php echo $tenmien; ?>/login/dangxuat.php">Đăng
                    Xuất</a>
                <?php } ?>
            </div>
        </div>
        <div class="navbar-content">
            <div class="navbar-logo click" onClick="location.href='<?php echo $tenmien; ?>/trangchu'">
                <img src="<?php echo $tenmien; ?>/img/logo_sara/ngang-trongsuot-noel.png" alt="">
            </div>
            <div class="navbar-search">
                <input type="text" id='timkiem' autocomplete="off" onkeyup="suggesting()" onfocus="open_sug()" onblur="close_sug()" placeholder="Tìm kiếm mặt hàng của bạn..."
                    class="search-input font-shopee2021-regular font-brown">
                <button id='search_btn' class="search-button">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
                <div class="search-result">
                    <div id='sugg' class="suggest-box font-brown dis-none">
                        
                    </div>
                </div>
            </div>
            <script>
                async function open_sug(){
                    document.getElementById("search_btn").addEventListener("click", function() {
                        search(document.getElementById('timkiem').value);
                        });
                        document.addEventListener('keydown', function (event) {
                        if (event.key === 'Enter') {
                            search(document.getElementById('timkiem').value);
                        }
                        });
                    document.getElementById('sugg').classList.remove("dis-none");
                }
                async function close_sug(){
                    await sleep(500);
                    document.getElementById('sugg').classList.add("dis-none");
                }
                function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
                }
                function suggesting(){
                    var tukhoa = document.getElementById('timkiem').value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById('sugg').innerHTML =
                                this.responseText;
                        }
                    };
                    xhttp.open('GET', 'http://localhost/search/search_sugg.php?key=' + tukhoa, true);
                    xhttp.send();
                }
                function search(tukhoa){
                    window.location = "<?php echo $tenmien; ?>/search/search.php?key="+ tukhoa;
                }
            </script>
            <div class="navbar-cart click">
                <span class="material-icons-outlined" onClick="location.href='<?php echo $tenmien; ?>/cart'" style="font-size: 2.5em;">shopping_cart</span>
                <span name='cart' class="cart-soluong font-shopee2021-light">
                    <?php
                     if(isset($_SESSION['cart']))
                     {
                         echo count($_SESSION['cart']);
                     }
                     else
                     {
                        echo 0;
                     }
                    ?>
                </span>
            </div>
        </div>
        
    </div>