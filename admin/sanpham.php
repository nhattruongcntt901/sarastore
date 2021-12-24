<?php
session_start();
if(!isset($_SESSION['id_loaiuser']))
{
  header("location: ../login/dangnhap.php?admin_page=true");
  die();
}
else
{
    if($_SESSION['id_loaiuser']==1 || $_SESSION['id_loaiuser'] == 2 || $_SESSION['id_loaiuser'] == 3)
  {
    header("location: ../trangchu");
    die();
  }
}
include("../include/ketnoi.php");
include("include/head.php");
$sql      = 'SELECT * FROM website';
$ketqua   = mysqli_query($ketnoi,$sql);
$row = mysqli_fetch_assoc($ketqua);
$truycap = $row['luottruycap'];

$rowsPerPage = 14; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$page_hientai = $_GET['page'];

if(!empty($_GET["id_sp"]))
{
    $id_sp = $_GET['id_sp'];
    $sql        = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 and id_sp = $id_sp LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 and id_sp = $id_sp";

}
else{
    $sql        = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1";

}

    


$ketqua1 = mysqli_query($ketnoi, $sql);

$ketqua_sodong = mysqli_query($ketnoi, $sql_sodong);
$sodong = mysqli_num_rows($ketqua_sodong);
$page = ceil($sodong / $rowsPerPage);
?>
<body>
    <link rel="stylesheet" href="include/admin.css">
    <div class="content">
        <div class="nav">
            <div class="nav-head">
                <img src="../img/avatar_user/<?php echo $_SESSION['anh_user']; ?>" style='border-radius:50%;width:50px;height:50px' alt="">
                <span class="font-shopee2021-light">Chào, <?php echo $_SESSION['ten_user']; ?></span>
            </div>
            <div class="nav-body">
                <?php $sanpham = true; include("include/nav.php"); ?>
            </div>
        </div>
        <div class="nav-content">
            <div class="content-head">
                <h3 class="font-shopee2021-bold">SẢN PHẨM</h3>
            </div>
            <div class="content-body">
                <form action="sanpham.php" method="get" style='width:100%;'>
                    <h3 style='width:100%;' align='center'>Tra Cứu Sản Phẩm</h3>
                    <div class="colume-login" style='margin-left:auto;margin-right:auto;width:30%'>
                        <span class="form-title">Tìm kiếm</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="text" name='id_sp' value="<?php if(isset($_GET['id_sp'])) echo $_GET['id_sp']; ?>" placeholder="Nhập ID Sản Phẩm">
                        </div>
                    </div>
                    <div style='width:100%;display:flex;justify-content:center;margin-top:20px'>
                        <button class="btn bg-brown font-white" style='margin-left:auto;margin-right:auto'>Tra Cứu</button>
                    </div>
                </form>
                <div style="display: flex;justify-content:center;width:100%;margin-top:20px">
                    <div class="container-fluid" style="width:auto">
                        <div class='flex-ngang'>
                            <?php if ($page_hientai != 1) { ?>
                            <!-- Trang đầu -->
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/sanpham.php?page=1<?php if(isset($_GET['id_sp'])) echo "&id_sp=".$_GET['id_sp']; ?>"><span
                                    class="material-icons">arrow_back_ios</span></a>
                            <!-- Trang trước -->

                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/sanpham.php?page=<?php echo $page_hientai - 1; ?><?php if(isset($_GET['id_sp'])) echo "&id_sp=".$_GET['id_sp']; ?>"><span
                                    class="material-icons">chevron_left</span></a>
                            <?php }else{ ?>
                            <a style='padding:10px;<?php echo "color:black"; ?>'><span
                                    class="material-icons">arrow_back_ios</span></a>
                            <!-- Trang trước -->

                            <a style='padding:10px;<?php echo "color:black"; ?>'><span
                                    class="material-icons">chevron_left</span></a>
                            <?php } ?>

                            <!-- Các trang thành phần -->
                            <?php
                    for ($i = 1; $i <= $page; $i++) {
                    ?>
                            <a style='padding:10px;<?php if ($i == $_GET['page']) {
                                                    echo "color:red";
                                                } else echo "color:gray"; ?>'
                                href="http://localhost/admin/sanpham.php?page=<?php echo $i; ?><?php if(isset($_GET['id_sp'])) echo "&id_sp=".$_GET['id_sp']; ?>"><?php echo $i; ?></a>
                            <?php
                    }
                    ?>

                            <!-- Trang sau -->
                            <?php if ($page_hientai != $page) { ?>
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/sanpham.php?page=<?php echo $page_hientai + 1; ?><?php if(isset($_GET['id_sp'])) echo "&id_sp=".$_GET['id_sp']; ?>"><span
                                    class="material-icons">navigate_next</span></a>


                            <!-- Trang cuối    -->
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/sanpham.php?page=<?php echo $page; ?><?php if(isset($_GET['id_sp'])) echo "&id_sp=".$_GET['id_sp']; ?>"><span
                                    class="material-icons">arrow_forward_ios</span></a>
                            <?php }else{ ?>
                            <a style='padding:10px;<?php echo "color:black"; ?>'><span
                                    class="material-icons">navigate_next</span></a>


                            <!-- Trang cuối    -->
                            <a style='padding:10px;<?php echo "color:black"; ?>'><span
                                    class="material-icons">arrow_forward_ios</span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div style='overflow-y:scroll;height:64vh'>
                <div class="sanphams">
                    <?php
                    if(mysqli_num_rows($ketqua1) > 0)
                    {
                        
                        while($row = mysqli_fetch_assoc($ketqua1))
                        {
                            $id_sp = $row['id_sp'];
                            $anhsp = $row['anh_sp'];
                            $tensp = $row['ten_sp'];
                            $daban = $row['soluongdaban_sp'];
                            $gia   = number_format($row['dongia_sp']);
                            ?>
                        <div class="sanpham click">
                            <div class="sp-img">
                                <img src="../../img/sanpham/<?php echo $anhsp;?>" style='width:100%' alt=""  onClick="location.href='http://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
                            </div>
                            <div class="sp-title" onClick="location.href='http://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
                                <?php echo $tensp; ?>
                            </div>
                            <div class="sp-price">
                                <span class="font-shopee2021-light price">₫ <?php echo $gia;?></span>
                                <span class="font-shopee2021-light sp-daban">Đã bán <?php echo $daban;?></span>
                            </div>
                            <div class="sp-chucnang">
                                <button class="btn btn-danger" onClick="location.href='https://localhost/admin/chucnang/xoa_sanpham.php?id_sp=<?php echo $id_sp;?>'">Xóa</button>
                            </div>
                        </div>

                    
                    <?php 
                        }
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>