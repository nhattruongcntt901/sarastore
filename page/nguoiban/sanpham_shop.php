<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$sanpham = true;
if(!isset($_SESSION['id_shop']))
    header("location:../../trangchu");
?>

<body>
    <?php include("../../include/navbar.php"); ?>
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
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='product-manager'">
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
            <div class="sidebar-item" onClick="location.href='don-mua'">
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
        <div class="noi-dung">
            <div class="title-info address-title">
                <div class="my-address">
                    <h5>SẢN PHẨM CỦA TÔI</h5>
                    <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Thêm các sản phẩm của bạn</span>
                </div>
                <div>
                    <button onclick="open_dialog('add_product')" style='display:flex;align-items:center'
                        class="btn bg-brown font-white"><span class="material-icons">add</span><span>Thêm Sản Phẩm
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
            <!-- Danh sách sản phẩm -->
            <div class="sanphams">
            <?php
            $id_shop = $_SESSION['id_shop'];
            $sql      = "SELECT * FROM sanpham WHERE id_shop = $id_shop and tinhtrang_sp = 1";
            $ketqua   = mysqli_query($ketnoi,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                while($row = mysqli_fetch_assoc($ketqua))
                { 
                    $id_sp = $row['id_sp'];
                    $anhsp = $row['anh_sp'];
                    $tensp = $row['ten_sp'];
                    $daban = $row['soluongdaban_sp'];
                    $gia   = number_format($row['dongia_sp']);
                    ?>
                <div class="sanpham">
                    <div class="sp-img">
                        <img src="../../img/sanpham/<?php echo $anhsp;?>" style='width:100%' alt="">
                    </div>
                    <div class="sp-title">
                        <?php echo $tensp; ?>
                    </div>
                    <div class="sp-price">
                        <span class="font-shopee2021-light price">₫ <?php echo $gia;?></span>
                        <span class="font-shopee2021-light sp-daban">Đã bán <?php echo $daban;?></span>
                    </div>
                    <div class="sp-chucnang">
                        <button class="btn btn-success" id="<?php echo $id_sp;?>" onclick="open_product_update(this.id)">Sửa</button>
                        <button class="btn btn-danger" onClick="location.href='https://localhost/page/nguoiban/chucnang/product_remove.php?id_sp=<?php echo $id_sp;?>'">Xóa</button>
                    </div>
                </div>
               <?php }
            }
            
            ?>
            
                
            </div>    
            
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
                            <div class="error1" style='float:right;color:brown;font-size:0.75em'>

                            </div>
                        </div>
                    </div>
                    <div class="row-login1">
                        <div class="colume-login">
                            <span class="form-title">Khối Lượng</span>
                            <div class="input-form">
                                <span class="material-icons">badge</span>
                                <input type="number" name='khoiluong' id='khoiluong'
                                    placeholder="Nhập khối lượng sản phẩm (đơn vị :gam) ..." required>
                            </div>
                            <div class="error">

                            </div>
                        </div>
                        
                        <div class="colume-login" id='chuahinh' style='display:flex;gap:10px;flex-wrap:wrap'>
                        
                            <img id='preview-img' src="../../img/sanpham/img-default.png" alt=""
                                style='width:75px;height:75px'>
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
<script>
    function anh_preview(){
        var themhinh = document.getElementById('hinhdaidien');
        console.log(themhinh.files.length);
        var chuahinh = document.getElementById('chuahinh')

            var hinh = document.createElement('img');
            hinh.src = URL.createObjectURL(themhinh.files[0]);
            hinh.style = "width:75px;height:75px";
            chuahinh.appendChild(hinh);
    
    }
</script>
</html>