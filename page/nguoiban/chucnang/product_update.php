<?php
session_start();
include("../../../include/ketnoi.php");
include("../../../include/chucnang.php");
if(!empty($_GET['id_sp'])){
    echo $_GET['id_sp'];
    $id_sp = $_GET['id_sp'];
    $id_shop = $_SESSION['id_shop'];
    $sql      = "SELECT * FROM sanpham WHERE id_sp = $id_sp and id_shop = $id_shop";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $id_sp      = $row['id_sp'];
        $tensp      = $row['ten_sp'];
        $gia        = $row['dongia_sp'];
        $soluong    = $row['soluong_sp'];
        $id_danhmuc = $row['id_dm'];
        $chieudai   = $row['chieudai_sp'];
        $chieurong  = $row['chieurong_sp'];
        $chieucao   = $row['chieucao_sp'];
        $khoiluong  = $row['khoiluong_sp'];
        $mota       = $row['mota_sp'];
    }
?>
<dialog id='update_product' open style='z-index:10001'>
    <div class="dialog">
        <div class="dialog-content">
            <div class="dialog-head">
                <span class="font-shopee2021-bold" style='color:rgb(0,0,0,0.6)'>
                    <h4 style='font-size:1em'>CẬP NHẬT SẢN PHẨM</h4>
                </span>
                <button onclick="close_dialog('update_product')" style='display:flex;align-items:center'
                    class="btn bg-brown font-white"><span class="material-icons">close</span></button>
            </div>
            <div id='thongbao_success' style='margin-top:20px'>

            </div>
            <form class="dialog-body scroll-dialog" id='themsp' method="post"
                action="../../page/nguoiban/chucnang/product_update.php" enctype="multipart/form-data">
                <div class="row-login1">
                    <div class="colume-login">
                        <span class="form-title">Tên Sản Phẩm</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="text" name='tensp' id='tensp1' value="<?php echo $tensp;?>"
                                placeholder="Nhập tên sản phẩm..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Giá Sản Phẩm</span>
                        <div class="input-form">
                            <span class="material-icons">phone</span>
                            <input type="number" name='giasp' id='giasp1' value="<?php echo $gia; ?>"
                                placeholder="Nhập giá sản phẩm..." required>
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
                            <input type="number" name='soluongsp' value="<?php echo $soluong; ?>" id='soluongsp1'
                                placeholder="Nhập số lượng kho của sản phẩm..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Danh Mục</span>
                        <select class='input-form' name='danhmuc' id='danhmuc1' required>
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
                                        if($id_dm != $id_danhmuc)
                                            echo "<option value='$id_dm'>$danhmuc</option>";
                                        else
                                            echo "<option value='$id_dm' selected>$danhmuc</option>";
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
                            <input type="number" name='chieudai' value="<?php echo $chieudai; ?>" id='chieudai1'
                                placeholder="Nhập chiều dài sản phẩm (đơn vị :cm) ..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Chiều rộng</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="number" name='chieurong' value="<?php echo $chieurong; ?>" id='chieurong1'
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
                            <input type="number" name='chieucao' value="<?php echo $chieucao;?>" id='chieucao1'
                                placeholder="Nhập chiều cao sản phẩm (đơn vị :cm) ..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                    <div class="colume-login">
                        <span class="form-title">Khối Lượng</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="number" name='khoiluong' id='khoiluong' value="<?php echo $khoiluong; ?>"
                                placeholder="Nhập khối lượng sản phẩm (đơn vị :gam) ..." required>
                        </div>
                        <div class="error">

                        </div>
                    </div>
                </div>

                <div class="row-login1">
                    <span class="form-title">Mô Tả Sản Phẩm</span>
                    <textarea id='mota1' name='mota'
                        style="width:100%;height:75px;padding:10px;border-radius:5px"><?php echo $mota; ?></textarea>
                </div>
                <div>
                    <input type="text" name='id_sp' style='display:none' value="<?php echo $id_sp;?>">
                    <button type="submit" name='btn-submit' class='login-btn font-shopee2021-bold bg-brown'>CẬP NHẬT SẢN
                        PHẨM</button>
                </div>
            </form>

            <div class="dialog-head">

            </div>
        </div>
    </div>

</dialog>
<?php } ?>

<?php 
if(isset($_POST['btn-submit'])&&isset($_POST['id_sp']))
{

        $back       = 0;
        $id_shop    = $_SESSION['id_shop'];
        $id_sanpham = $_POST['id_sp'];
        $tensp      = $_POST['tensp'];
        $gia        = $_POST['giasp'];
        $soluong    = $_POST['soluongsp'];
        $id_danhmuc = $_POST['danhmuc'];
        $chieudai   = $_POST['chieudai'];
        $chieurong  = $_POST['chieurong'];
        $chieucao   = $_POST['chieucao'];
        $khoiluong  = $_POST['khoiluong'];
        $mota       = $_POST['mota'];


    if(empty($tensp))
    {
        $_SESSION['error_tensp'] = "Không được để trống";
        $back++;
        
    }else if(strlen($tensp)>100){$_SESSION['error_tensp'] = "Tối đa 100 kí tự";$back++;}
    if(empty($gia)||is_numeric($gia)==false)
    {
        $_SESSION['error_gia'] = "Không được để trống";
        $back++;
    }
    if(empty($soluong)||is_numeric($soluong)==false)
    {
        $_SESSION['error_soluong'] = "Không được để trống";
        $back++;
        
    }
    if(empty($id_danhmuc)||is_numeric($id_danhmuc)==false)
    {
        $_SESSION['error_id_danhmuc'] = "Không được để trống";
        $back++;
        
    }
    if(empty($chieudai)||is_numeric($chieudai)==false)
    {
        $_SESSION['error_chieudai'] = "Không được để trống";
        $back++;
        
    }
    if(empty($chieurong)||is_numeric($chieurong)==false)
    {
        $_SESSION['error_chieurong'] = "Không được để trống";
        $back++;
        
    }
    if(empty($chieucao)||is_numeric($chieucao)==false)
    {
        $_SESSION['error_chieucao'] = "Không được để trống";
        $back++;
    }
    if($mota=="")
        $mota = "Không có mô tả";
    if($back!=0)
    {
        $_SESSION['thongbao_update_fail'] = "Chỉnh Sửa Thất Bại";
        
    }

    $tensp      = htmlspecialchars($tensp);
    $gia        = htmlspecialchars($gia);
    $chieurong  = htmlspecialchars($chieurong);
    $chieucao   = htmlspecialchars($chieucao);
    $chieudai   = htmlspecialchars($chieudai);
    $id_danhmuc = htmlspecialchars($id_danhmuc);
    $soluong    = htmlspecialchars($soluong);
    $mota       = htmlspecialchars($mota);
    $khoiluong  = htmlspecialchars($khoiluong);
    $sql      = "SELECT * FROM sanpham WHERE id_sp = $id_sanpham";
    $ketqua   = mysqli_query($ketnoi,$sql);
    $row = mysqli_fetch_assoc($ketqua);
    if($id_shop==$row['id_shop'])
    {
        
        update_table("sanpham","ten_sp",$tensp,"id_sp",$id_sanpham);
        update_table("sanpham","soluong_sp",$soluong,"id_sp",$id_sanpham);
        update_table("sanpham","dongia_sp",$gia,"id_sp",$id_sanpham);
        update_table("sanpham","chieudai_sp",$chieudai,"id_sp",$id_sanpham);
        update_table("sanpham","chieurong_sp",$chieurong,"id_sp",$id_sanpham);
        update_table("sanpham","chieucao_sp",$chieucao,"id_sp",$id_sanpham);
        update_table("sanpham","mota_sp",$mota,"id_sp",$id_sanpham);
        update_table("sanpham","khoiluong_sp",$khoiluong,"id_sp",$id_sanpham);
        update_table("sanpham","id_dm",$id_danhmuc,"id_sp",$id_sanpham);
        $_SESSION['thongbao_update_success'] = "Chỉnh Sửa Thành Công";
        echo "<script>window.history.back(-1);</script>";
    }
    else
    {
        $_SESSION['thongbao_update_fail'] = "Chỉnh Sửa Thất Bại";
        echo "<script>window.history.back(-1);</script>";
    }   
}
?>