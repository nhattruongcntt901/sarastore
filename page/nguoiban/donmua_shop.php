<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$donmua= true;
if(!isset($_SESSION['id_shop']))
    header("location:../../trangchu");
?>

<body>
    <?php include("../../include/navbar_nguoiban.php"); ?>
    <!-- body content -->
    <div class="body-content" style="display: flex;margin-bottom:40px">
        <div class="sidebar">
        <div style='display:flex;align-items:center'>
                <div class="account-img">
                    <img src="../img/avatar_shop/<?php echo $anh_shop;?>" alt="">
                </div>
                <div class="acount-name">
                    <span class="font-shopee2021-bold"><?php echo $ten_shop;?></span>
                </div>
            </div>
            <hr width="90%" style="color: rbg(255,255,255,0.5);">
            <div class="sidebar-item" onClick="location.href='product-manager'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">inventory_2</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Sản Phẩm</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='info'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thông Tin Shop</span>
                </div>
            </div>
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='don-mua'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn hàng</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='thong-ke'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thống Kê Doanh Số</span>
                </div>
            </div>
        </div>
        <div class="noi-dung" style='background-color:transparent'>
            <div class="title-info address-title">
                <div class="my-address">
                    <h5>ĐƠN MUA CỦA TÔI</h5>
                    <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Các đơn mua của bạn</span>
                </div>
            </div>
            <hr width="95%">
            <div class="don-hang">
                <div class="cart-area">
                    <?php
                    $sql      = "SELECT gia_ship, id_donhang, ma_don, a.id_shop, ten_shop,gia_cod FROM donhang a,shop b WHERE a.id_shop = $id_shop and a.id_shop = b.id_shop ORDER BY id_donhang DESC";
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
                            <span class="font-shopee2021-bold" style='margin-left:auto'>Mã đơn:
                                <?php echo $madon; ?></span>
                        </div>
                    </div>
                    <div
                        style='display:flex;border-bottom:1px solid rgb(0,0,0,0.1);border-top:1px solid rgb(0,0,0,0.1);padding-top:10px;background-color:white'>
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
                        <div style="display:flex;align-items:center;gap:10px;margin:10px;color:green"
                            class="font-shopee2021-bold">
                            <span class="material-icons">local_shipping</span>
                            <span>NHÀ VẬN CHUYỂN</span>
                        </div>
                        <div class="font-shopee2021-light" style='color:#44a072;'>
                            <span style='margin-right:10px'>Ngày tạo đơn:</span><span
                                class="font-shopee2021-bold"><?php echo $ttvc[4]; ?></span><br>
                            <span style='margin-right:10px'>Nhà vận chuyển:</span><span
                                class="font-shopee2021-bold"><?php echo $ttvc[2]; ?></span><br>
                            <span style='margin-right:10px'>Phí vận chuyển:</span><span class="font-shopee2021-bold">
                                ₫<?php echo number_format($gia_ship); ?></span><br>
                            <span style='margin-right:10px'>Dự kiến nhận hàng:</span><span
                                class="font-shopee2021-bold"><?php echo $ttvc[3]; ?></span><br>
                            <span style='margin-right:10px'>Trạng thái:</span><span
                                class="font-shopee2021-bold"><?php echo $ttvc[1]; ?></span>
                        </div>
                        <hr width="95%">
                    </div>
                    <div class="thanh-toan font-shopee2021-bold" style='color:#a56969;'>
                        <span style='font-size:1.5em'>Tổng tiền: ₫</span><span
                            style='font-size:2em'><?php echo number_format($gia_cod+$gia_ship); ?></span>
                    </div>
                    <?php
                            }
                        }
                    }
                    ?>


                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->


    </div>
    </div>
    <div id="update_product_data"></div>
    <dialog id='add_product' style='z-index:10000'>
        <div class="dialog">
            <div class="dialog-content">
                <div class="dialog-head">
                    <span class="font-shopee2021-bold" style='color:rgb(0,0,0,0.6)'>
                        <h4 style='font-size:1em'>THÊM SẢN PHẨM MỚI</h4>
                    </span>
                    <button onclick="close_dialog('add_product')" style='display:flex;align-items:center'
                        class="btn bg-brown font-white"><span class="material-icons">close</span></button>
                </div>
                <div id='thongbao_success' style='margin-top:20px'>

                </div>
                <form class="dialog-body scroll-dialog" id='themsp'>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Tên Sản Phẩm</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="text" name='tensp' id='tensp' placeholder="Nhập tên sản phẩm..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Giá Sản Phẩm</span>
                            <div class="input-form">
                                <span class="material-icons">phone</span>
                                <input type="number" name='giasp' id='giasp' placeholder="Nhập giá sản phẩm..."
                                    required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Số Lượng Kho</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="number" name='soluongsp' id='soluongsp'
                                    placeholder="Nhập số lượng kho của sản phẩm..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Danh Mục</span>
                            <select class='input-form' name='danhmuc' id='danhmuc' required>
                                <option disabled selected>Chọn Danh Mục</option>
                                <?php
                                    $sql = "SELECT * FROM danhmuc";

                                    $ketqua = mysqli_query($ketnoi,$sql);

                                    if(mysqli_num_rows($ketqua) > 0)
                                    {
                                        while ($row = mysqli_fetch_assoc($ketqua))
                                        {
                                            $danhmuc = $row['ten_dm'];
                                            $id_dm = $row['id_dm'];
                                            echo "<option value='$id_dm'>$danhmuc</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <div class="error">

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Chiều dài</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="number" name='chieudai' id='chieudai'
                                    placeholder="Nhập chiều dài sản phẩm (đơn vị :cm) ..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Chiều rộng</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="number" name='chieurong' id='chieurong'
                                    placeholder="Nhập chiều rộng sản phẩm (đơn vị :cm) ..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Chiều cao</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="number" name='chieucao' id='chieucao'
                                    placeholder="Nhập chiều cao sản phẩm (đơn vị :cm) ..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                        <div class="colume-login">
                            <span class="form-title">Hình đại diện</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="file" name='image' id='hinhdaidien' required
                                    accept="image/png, image/jpg, image/jpeg">
                            </div>
                            <div class="error">

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                        </div>
                        <div class="colume-login">
                            <img id='preview-img' src="../../img/sanpham/img-default.png" alt=""
                                style='width:237px;height:200px'>
                            <div class="error">

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <span class="form-title">Mô Tả Sản Phẩm</span>
                        <textarea id='mota' style="width:100%;height:75px;padding:10px;border-radius:5px"></textarea>
                    </div>
                </form>
                <div>
                    <button type="submit" id="submit" name='btn-submit'
                        class='login-btn font-shopee2021-bold bg-brown'>THÊM SẢN
                        PHẨM</button>
                </div>
                <div class="dialog-head">

                </div>
            </div>
        </div>
    </dialog>
    <!-- crop image -->
    <div style='z-index:10001' class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cắt Ảnh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="sample_image" />
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/index.js"></script>
    <script src="../../js/vitri.js"></script>
    <script src="../../js/cathinh.js"></script>
    <?php
    include("../../include/footer.php");
    ?>
</body>

</html>