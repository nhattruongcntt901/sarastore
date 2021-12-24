<?php
session_start();
if(!isset($_SESSION['id_loaiuser']))
{
  header("location: ../login/dangnhap.php?admin_page=true");
  die();
}
else
{
    if($_SESSION['id_loaiuser']==1 || $_SESSION['id_loaiuser'] == 2)
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

$rowsPerPage = 15; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$page_hientai = $_GET['page'];

if(!empty($_GET["ma_don"]))
{
    $ma_don = $_GET['ma_don'];
    $sql        = "SELECT * FROM donhang WHERE ma_don like '$ma_don' LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM donhang WHERE ma_don like '$ma_don'";

}
else{
    $sql        = "SELECT * FROM donhang LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM donhang";

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
            <?php $donhang = true; include("include/nav.php"); ?>
            </div>
        </div>
        <div class="nav-content">
            <div class="content-head">
                <h3 class="font-shopee2021-bold">SẢN PHẨM</h3>
            </div>
            <div class="content-body">
                <form action="donhang.php" method="get" style='width:100%;'>
                    <h3 style='width:100%;' align='center'>Tra Cứu Đơn Hàng</h3>
                    <div class="colume-login" style='margin-left:auto;margin-right:auto;width:30%'>
                        <span class="form-title">Tìm kiếm</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="text" name='ma_don' value="<?php if(isset($_GET['ma_don'])) echo $_GET['ma_don']; ?>" placeholder="Nhập Mã Đơn Sản Phẩm">
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
                                href="http://localhost/admin/donhang.php?page=1<?php if(isset($_GET['ma_don'])) echo "&id_sp=".$_GET['ma_don']; ?>"><span
                                    class="material-icons">arrow_back_ios</span></a>
                            <!-- Trang trước -->

                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/donhang.php?page=<?php echo $page_hientai - 1; ?><?php if(isset($_GET['ma_don'])) echo "&ma_don=".$_GET['id_sp']; ?>"><span
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
                                href="http://localhost/admin/donhang.php?page=<?php echo $i; ?><?php if(isset($_GET['ma_don'])) echo "&ma_don=".$_GET['ma_don']; ?>"><?php echo $i; ?></a>
                            <?php
                    }
                    ?>

                            <!-- Trang sau -->
                            <?php if ($page_hientai != $page) { ?>
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/donhang.php?page=<?php echo $page_hientai + 1; ?><?php if(isset($_GET['ma_don'])) echo "&ma_don=".$_GET['id_sp']; ?>"><span
                                    class="material-icons">navigate_next</span></a>


                            <!-- Trang cuối    -->
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/donhang.php?page=<?php echo $page; ?><?php if(isset($_GET['ma_don'])) echo "&ma_don=".$_GET['ma_don']; ?>"><span
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
                <table id='customers' class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã Đơn</th>
                            <th>ID User</th>
                            <th>ID Shop</th>
                            <th>Giá COD</th>
                            <th>Giá SHIP</th>
                            <th>Thời Gian Đặt</th>
                            <th>Tình Trạng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if(mysqli_num_rows($ketqua1) > 0)
                                {
                                    
                                    while($row = mysqli_fetch_assoc($ketqua1))
                                    {
                                        $id_donhang     = $row['id_donhang'];
                                        $ma_don         = $row['ma_don'];
                                        $id_user        = $row['id_user'];
                                        $id_shop        = $row['id_shop'];
                                        $gia_cod        = $row['gia_cod'];
                                        $gia_ship       = $row['gia_ship'];
                                        $time           = $row['thoigiandat_donhang'];
                                        $tinh_trang     = $row['tinhtrang_donhang'];
                                        $gia_cod = number_format($gia_cod);
                                        $gia_ship= number_format($gia_ship);
                                        if($tinh_trang==1)
                                            $tinh_trang = "Đã Hoàn Thành";
                                        else
                                            $tinh_trang = "Đang Vận Chuyển";
                                        echo "
                                        <tr>
                                            <td>$id_donhang</td>
                                            <td>$ma_don</td>
                                            <td>$id_user</td>
                                            <td>$id_shop</td>
                                            <td>$gia_cod VNĐ</td>
                                            <td>$gia_ship VNĐ</td>
                                            <td>$time</td>
                                            <td>$tinh_trang</td>
                                        </tr>";
                            ?>
                        <?php
                                                }
                                            }
                                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>