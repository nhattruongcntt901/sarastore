<?php
session_start();
include("../../../include/ketnoi.php");
include("../../../include/chucnang.php");

if(isset($_POST['btn-submit']))
{
    $back   = 0;

    $id_user= $_SESSION['id_user'];
    $id_diachi = $_POST['id_diachi'];
    $hoten  = $_POST['hoten'];
    $sdt    = $_POST['sdt'];
    $tinh   = $_POST['tinh'];
    $huyen  = $_POST['huyen'];
    $xa     = $_POST['xa'];
    $sonha  = $_POST['sonha'];



    if(empty($hoten))
    {
        $_SESSION['error_hoten'] = "Không được để trống";
        $back++;
    }else if(strlen($hoten)>40){$_SESSION['error_hoten'] = "Tối đa 40 kí tự";$back++;}
    if(empty($sdt))
    {
        $_SESSION['error_sdt'] = "Không được để trống";
        $back++;
    }else if(strlen($sdt)!=10 && is_numeric($sdt)){$_SESSION['error_sdt'] = "Số điện thoại không đúng";$back++;}
    if(empty($tinh))
    {
        $_SESSION['error_tinh'] = "Không được để trống";
        $back++;
    }
    if(empty($huyen))
    {
        $_SESSION['error_huyen'] = "Không được để trống";
        $back++;
    }
    if(empty($xa))
    {
        $_SESSION['error_xa'] = "Không được để trống";
        $back++;
    }
    if(empty($sonha))
    {
        $_SESSION['error_sonha'] = "Không được để trống";
        $back++;
    }
    if($back!=0)
    {
        $_SESSION['thongbao_update_fail'] = "Chỉnh Sửa Thất Bại";
        echo "<script>window.history.back(-1);</script>";
        die();
    }


    $value_check  = [$hoten,$sdt,$sonha,$xa,$huyen,$tinh];
    if(CheckSpecialChar($value_check)==true)
    {
        $_SESSION['error_specialChar']="Thông tin nhập vào có chứa ký tự đặc biệt";
        $back++;
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    if($back!=0)
    {
        $_SESSION['thongbao_update_fail'] = "Chỉnh Sửa Thất Bại";
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    else
    {
        $sql      = "SELECT * FROM diachiuser WHERE id_diachi = $id_diachi";
        $ketqua   = mysqli_query($ketnoi,$sql);
        $row = mysqli_fetch_assoc($ketqua);
        if($id_user==$row['id_user'])
        {
            update_table("diachiuser","tennguoinhan",$hoten,"id_diachi",$id_diachi);
            update_table("diachiuser","sdt",$sdt,"id_diachi",$id_diachi);
            update_table("diachiuser","tenduong",$sonha,"id_diachi",$id_diachi);
            update_table("diachiuser","xa",$xa,"id_diachi",$id_diachi);
            update_table("diachiuser","huyen",$huyen,"id_diachi",$id_diachi);
            update_table("diachiuser","tinh",$tinh,"id_diachi",$id_diachi);
            $_SESSION['thongbao_update_success'] = "Chỉnh Sửa Thành Công";
            echo "<script>window.history.back(-1);</script>";
        }
        else
        {
            $_SESSION['thongbao_update_fail'] = "Chỉnh Sửa Thất Bại";
            echo "<script>window.history.back(-1);</script>";
        }   
    }
}
?>
<?php 

if(!empty($_GET['id_diachi']))
{ 
    $id_diachi = $_GET['id_diachi'];
    $id_user = $_SESSION['id_user'];    
    $sql      = "SELECT * FROM diachiuser WHERE id_diachi = $id_diachi AND id_user = $id_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $hoten  = $row['tennguoinhan'];
        $sdt    = $row['sdt'];
        $sonha  = $row['tenduong'];
        $xa     = $row['xa'];
        $huyen  = $row['huyen'];
        $tinh   = $row['tinh'];
    }
    else 
        die();
?>
<dialog id='update_address' open>
    <div class="dialog">
        <div class="dialog-content">
            <div class="dialog-head">
                <span class="font-shopee2021-bold" style='color:rgb(0,0,0,0.6)'>
                    <h4 style='font-size:1em'>CẬP NHẬT ĐỊA CHỈ</h4>
                </span>
                <button onclick="close_dialog('update_address')" style='display:flex;align-items:center'
                    class="btn bg-brown font-white"><span class="material-icons">close</span></button>
            </div>
            <form class="dialog-body" action="../../page/nguoimua/chucnang/address_update.php" method="post">
                <input style='display:none' name='id_diachi' value="<?php echo $id_diachi;?>" />
                <div class="row-login1">
                    <div class="colume-login">
                        <span class="form-title">Họ và Tên</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="text" value="<?php echo $hoten; ?>" name='hoten' placeholder="Nhập họ tên người nhận..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Số Điện Thoại</span>
                        <div class="input-form">
                            <span class="material-icons">phone</span>
                            <input type="text" value="<?php echo $sdt; ?>" name='sdt' placeholder="Nhập số điện thoại người nhận..." required>
                        </div>
                        <div class="error">
                           
                        </div>
                    </div>
                </div>
                <div class="row-login1">
                    <!-- Chọn Tỉnh -->
                    <div class="colume-login">
                        <span class="form-title">Chọn Tỉnh</span>
                        <select class='input-form' name='tinh' id='tinh1' onclick="province_update()" onchange="after_choose_province(value)" required>
                                <option disabled selected>Chọn Tỉnh</option>
                                
                            </select>
                        <div class="error">
                           
                        </div>
                    </div>
                    <div class="colume-login">
                        <!-- Chọn Huyện -->
                        <span class="form-title">Chọn Huyện/Thành Phố</span>
                        <select class='input-form' name='huyen' id='huyen' onchange="after_choose_district(value)" required>
                                <option disabled selected>Chọn Huyện/Thành Phố</option>
                            </select>
                        <div class="error">
                           
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
                            
                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Số Nhà, Tên Đường</span>
                        <div class="input-form">
                            <input value="<?php echo $sonha; ?>" type="text" name='sonha' placeholder="Nhập số nhà tên đường" required>
                        </div>
                        <div class="error">
                            
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" name='btn-submit' class='login-btn font-shopee2021-bold bg-brown'>CẬP NHẬT ĐỊA
                        CHỈ</button>
                </div>
            </form>
            <div class="dialog-head">

            </div>
        </div>
    </div>
</dialog>
<?php } ?>