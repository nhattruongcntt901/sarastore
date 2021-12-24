<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$account = true;
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
                    <span class="font-shopee2021-bold"><?php echo $ten; ?></span>
                </div>
            </div>
            <hr width="90%" style="color: rbg(255,255,255,0.5);">
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='profile'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #4459a0;">account_circle</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Tài Khoản Của Tôi</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='address'">
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
            <div class="title-info">
                <h5>HỒ SƠ CỦA TÔI</h5>
                <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                <hr width="95%">
            </div>
            <div class="info-content">
                <div class="error" style="text-align: start;margin-bottom:10px">
                    <?php if(isset($_SESSION['error_specialChar'])) { echo $_SESSION['error_specialChar']; unset($_SESSION['error_specialChar']); }?>
                </div>
                <div style="text-align: start;margin-bottom:10px;color:green;font-weight:bold">
                    <?php if(isset($_SESSION['success_update'])) { echo $_SESSION['success_update']; unset($_SESSION['success_update']); }?>
                </div>
                <div class="info-content" >
                    <form class="edit-form" action="update" method="post" enctype="multipart/form-data">
                        <div class="form">
                            <div class="demuc-form">
                                <span>Tên Đăng Nhập</span>
                            </div>
                            <div class="thongtin-form">
                                <span><?php echo $tendn;?></span>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Họ</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='ho' type="text" class="input-form1" value="<?php echo $ho;?>">
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Tên</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='ten' type="text" class="input-form1" value="<?php echo $ten;?>">
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Email</span>
                            </div>
                            <div class="thongtin-form">
                                <span><?php echo $email;?></span>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Số Điện Thoại</span>
                            </div>
                            <div class="thongtin-form">
                                <span><?php echo $sdt;?></span>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Giới Tính</span>
                            </div>
                            <div class="thongtin-form">
                                <select class="input-form-select" name="gioitinh" required>
                                    <option value="Nam" <?php if($gioitinh=="Nam") echo "selected"; ?>>Nam</option>
                                    <option value="Nữ" <?php if($gioitinh=="Nữ") echo "selected"; ?>>Nữ</option>
                                    <option value="Khác" <?php if($gioitinh=="Khác") echo "selected"; ?>>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="demuc-form">
                                <span>Ngày Sinh</span>
                            </div>
                            <div class="thongtin-form">
                                <input name='ngaysinh' type="date" class="input-form1" value="<?php echo $ngaysinh;?>">
                            </div>
                        </div>
                        <?php if(isset($_SESSION['error_ten'])||isset($_SESSION['error_ho'])||isset($_SESSION['error_gioitinh'])||isset($_SESSION['error_ngaysinh'])){?>
                        <div class="form" style="flex-wrap: wrap;">
                            <div class="demuc-form" style="width: 100%;">
                            </div>
                            <div class="thongtin-form" style="width: 100%;flex-wrap: wrap;">
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_ho'])) { echo $_SESSION['error_ho']; unset($_SESSION['error_ho']); }?>
                                </div>
                                <div class="error" style="text-align: start;margin-bottom:10px">
                                    <?php if(isset($_SESSION['error_ten'])) { echo $_SESSION['error_ten']; unset($_SESSION['error_ten']); }?>
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
                                    <img style="border-radius:50%;width:200px;height:200px" id="uploaded_image" src="../../img/avatar_user/<?php if($avatar == "default_avatar.jpg"){
                                        if($gioitinh=="Nam")
                                            echo "default_avatar_boy.jpg";
                                        else
                                            echo "default_avatar_girl.jpg";
                                    }else echo $avatar;?>" alt="">
                                        <div class="overlay">
                                            <div class="text font-shopee2021-bold">Đổi ảnh đại diện</div>
                                        </div>
                                        <input type="file" name="image" class="image" id="upload_image" style="display:none" accept="image/png,image/jpg,image/jpeg"/>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <div style="width:100%;text-align:center;font-style:italic" class="font-shopee2021-light">Click Vào Hình Để Đổi Ảnh Đại Diện</div>
                    
                        
                        <!-- <div class="choose-file">
                            <div class="hide-file font-shopee2021-regular font-white">
                                Chọn Ảnh...
                                <input accept="image/png, image/jpeg, image/jpg" type="file" class="input-file"
                                    onchange="previewFile()" id="upload_image" name='avatar-img'>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- crop image -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
    <script>
    function previewFile() {
        var preview = document.getElementById('uploaded_image');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
    </script>

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
					url:'update',
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