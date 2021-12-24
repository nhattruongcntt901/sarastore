<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$thongtinshop = true;
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
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='info'">
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
                    <h5>THÔNG TIN CỦA SHOP</h5>
                    <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Chỉnh sửa thông tin phù hợp để có thể thu hút
                        nhiều khách hàng hơn</span>
                </div>
            </div>
            <hr width="95%">
            <!-- thông báo cập nhật, xóa -->
            <?php if(isset($_SESSION['thongbao_remove_success'])){ ?>
            <div>
                <div class="font-shopee2021-regular"
                    style='background-color:rgba(255, 0, 0, 0.4);width:auto;display:flex;align-items:center;gap:10px;padding:10px 20px;border-radius:5px'>
                    <span class="material-icons font-white">remove_circle</span>
                    <span style='color:white'>Xóa thành công<?php unset($_SESSION['thongbao_remove_success']);?></span>
                </div>
                <hr width="95%">
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['thongbao_update_success'])){ ?>
            <div>
                <div class="font-shopee2021-regular"
                    style='background-color:#04522b;width:auto;display:flex;align-items:center;gap:10px;padding:10px 20px;border-radius:5px'>
                    <span class="material-icons font-white">check_circle</span>
                    <span style='color:white'>Chỉnh Sửa thành
                        công<?php unset($_SESSION['thongbao_update_success']);?></span>
                </div>
                <hr width="95%">
            </div>
            <?php } ?>
            <!-- Danh sách sản phẩm -->
            <div class="info-content">
                <div class="error" style="text-align: start;margin-bottom:10px">
                    <?php if(isset($_SESSION['error_specialChar'])) { echo $_SESSION['error_specialChar']; unset($_SESSION['error_specialChar']); }?>
                </div>
                <div style="text-align: start;margin-bottom:10px;color:green;font-weight:bold">
                    <?php if(isset($_SESSION['success_update'])) { echo $_SESSION['success_update']; unset($_SESSION['success_update']); }?>
                </div>
                <div class="info-content">
                    <form class="edit-form" action="shop_update" method="post" enctype="multipart/form-data">
                        <div class="form">
                            <div class="demuc-form">
                                <span>Tên Shop</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='tenshop' type="text" class="input-form1" value="<?php echo $ten_shop;?>">
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Số Điện Thoại</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='sdtshop' type="text" class="input-form1" value="<?php echo $sdt_shop;?>">
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Danh Mục Shop</span>
                            </div>
                            <div class="thongtin-form">
                                <select class="input-form-select" name="nganhhang" required>
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
                                                if($id_dm_shop == $id_dm)
                                                    echo "<option value='$id_dm' selected>$ten_dm</option>";
                                                else
                                                    echo "<option value='$id_dm'>$ten_dm</option>";
                                            }
                                        }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Tỉnh</span>
                            </div>
                            <div class="thongtin-form">
                            <select class='input-form-select' name='tinh' id='tinh' onchange="after_choose_province(value)" required>
                                <option disabled selected>Chọn Tỉnh</option>
                        
                            </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Huyện/Thành Phố</span>
                            </div>
                            <div class="thongtin-form">
                            <select class='input-form-select' name='huyen' id='huyen' onchange="after_choose_district(value)"  required>
                                <option disabled selected>Chọn Huyện/Thành Phố</option>
                            </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Xã/Phường</span>
                            </div>
                            <div class="thongtin-form">
                                <select class='input-form-select' name='xa' id='xa' required>
                                    <option disabled selected>Chọn Xã/Phường</option>
                                </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Tên Đường</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='tenduong' type="text" class="input-form1" value="<?php echo $tenduong;?>">
                            </div>
                        </div>
                        <?php if(isset($_SESSION['error_tenshop'])||isset($_SESSION['error_sdt'])||isset($_SESSION['error_nganhhang'])||isset($_SESSION['error_tinh'])||isset($_SESSION['error_huyen'])||isset($_SESSION['error_xa'])||isset($_SESSION['error_tenduong'])){?>
                        <div class="form" style="flex-wrap: wrap;">
                            <div class="demuc-form" style="width: 100%;">
                            </div>
                            <div class="thongtin-form" style="width: 100%;flex-wrap: wrap;">
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_tenshop'])) { echo $_SESSION['error_tenshop']; unset($_SESSION['error_tenshop']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_sdt'])) { echo $_SESSION['error_sdt']; unset($_SESSION['error_sdt']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_tinh'])) { echo $_SESSION['error_tinh']; unset($_SESSION['error_tinh']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_huyen'])) { echo $_SESSION['error_huyen']; unset($_SESSION['error_huyen']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_xa'])) { echo $_SESSION['error_xa']; unset($_SESSION['error_xa']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_nganhhang'])) { echo $_SESSION['error_nganhhang']; unset($_SESSION['error_nganhhang']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_tenduong'])) { echo $_SESSION['error_tenduong']; unset($_SESSION['error_tenduong']); }?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form">
                            <div class="demuc-form">
                            </div>
                            <div class="thongtin-form">
                                <button class="font-shopee2021-regular" type="submit" name='btn-luu'
                                    style="padding: 10px 20px 10px 20px;font-size:1.2em;background-color:#a58b69;border:none;color:white;border-radius:5px">Lưu</button>
                            </div>
                        </div>
                    </form>
                    <div class="avatar-img-info">
                        <div>
                            <div class="image_area" style='padding:10px'>
                                <form method="post">
                                    <label for="upload_image">
                                        <img style="border-radius:50%;width:200px;height:200px" id="uploaded_image" src="../../img/avatar_shop/<?php echo $anh_shop; ?>" alt="">
                                        <div class="overlay">
                                            <div class="text font-shopee2021-bold">Đổi ảnh đại diện</div>
                                        </div>
                                        <input type="file" name="image" class="image" id="upload_image"
                                            style="display:none" accept="image/png,image/jpg,image/jpeg" />
                                    </label>
                                </form>
                            </div>
                        </div>
                        <div style="width:100%;text-align:center;font-style:italic" class="font-shopee2021-light">Click
                            Vào Hình Để Đổi Ảnh Đại Diện</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
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
    <script src="../../js/tinhthanh.js"></script>
    <?php
    include("../../include/footer.php");
    ?>
</body>

</html>

<script>

$(document).ready(function(){

	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'shop_update',
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
						$modal.modal('hide');
                        localStorage.clear();
                        location.reload();
					}
				});
			};
		});
	});
	
});
</script>