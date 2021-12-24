<?php
session_start();
include("../include/ketnoi.php");
if(!isset($_SESSION['id_loaiuser']))
{
  header("location: ../login/dangnhap.php?admin_page=true");
  die();
}
else
{
    if($_SESSION['id_loaiuser']==1 || $_SESSION['id_loaiuser'] == 2 || $_SESSION['id_loaiuser'] == 3 || $_SESSION['id_loaiuser'] == 4)
  {
    header("location: ../trangchu");
    die();
  }
}


$rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$page_hientai = $_GET['page'];

if(!empty($_GET['hoten']) && !empty($_GET['loaiuser']))
{
    $hoten = str_replace(" ","%",$_GET['hoten']);
    $loaiuser = $_GET['loaiuser'];
    $sql        = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and (CONCAT_WS(' ',ho_user,ten_user) like '%$hoten%' or email_user like '%$hoten%' or tendangnhap_user like '%$hoten%') and a.id_loaiuser = $loaiuser LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and (CONCAT_WS(' ',ho_user,ten_user) like '%$hoten%' or email_user like '%$hoten%' or tendangnhap_user like '%$hoten%') and a.id_loaiuser = $loaiuser";
    
}
else if(!empty($_GET['hoten']))
{
    $hoten = str_replace(" ","%",$_GET['hoten']);
    $sql        = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and (CONCAT_WS(' ',ho_user,ten_user) like '%$hoten%' or email_user like '%$hoten%' or tendangnhap_user like '%$hoten%') LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and (CONCAT_WS(' ',ho_user,ten_user) like '%$hoten%' or email_user like '%$hoten%' or tendangnhap_user like '%$hoten%')";
}
else if(!empty($_GET['loaiuser']))
{
    $loaiuser = $_GET['loaiuser'];
    $sql        = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and a.id_loaiuser = $loaiuser LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser and a.id_loaiuser = $loaiuser";
}
else
{
    $sql        = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser LIMIT $offset,$rowsPerPage";
    $sql_sodong = "SELECT * FROM user a, loaiuser b WHERE a.id_loaiuser = b.id_loaiuser";
}
    

$ketqua1 = mysqli_query($ketnoi, $sql);

$ketqua_sodong = mysqli_query($ketnoi, $sql_sodong);
$sodong = mysqli_num_rows($ketqua_sodong);
$page = ceil($sodong / $rowsPerPage);



include("include/head.php");
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
            <?php $user = true; include("include/nav.php"); ?>
            </div>
        </div>
        <div class="nav-content">
            <div class="content-head">
                <h3 class="font-shopee2021-bold">DANH SÁCH NGƯỜI DÙNG</h3>
            </div>
            <div class="content-body">
                <form action="user.php" method="get" style='width:100%;'>
                    <h3 style='width:100%;' align='center'>Tra Cứu USER</h3>
                    <div class="colume-login" style='margin-left:auto;margin-right:auto;width:30%'>
                        <span class="form-title">Tìm kiếm</span>
                        <div class="input-form">
                            <span class="material-icons">badge</span>
                            <input type="text" name='hoten' value="<?php if(isset($_GET['hoten'])) echo $_GET['hoten']; ?>" placeholder="Nhập họ tên/ Email / Tên đăng nhập....">
                        </div>
                    </div>
                    <div style='width:100%;display:flex;justify-content:center;margin-top:20px'>
                        <select class="input-form" name="loaiuser" id="" style='color:black;width:30%'>
                        <option disabled selected>Chọn Loại USER</option>
                                    <?php 
                                    $sql      = 'SELECT * FROM loaiuser';
                                    $ketqua   = mysqli_query($ketnoi,$sql);
                                    if(mysqli_num_rows($ketqua)>0)
                                    {
                                        while($row = mysqli_fetch_assoc($ketqua))
                                        {
                                            $id_loai = $row['id_loaiuser'];
                                            $tenloai1 = $row['ten_loaiuser'];
                                            if(isset($_GET['loaiuser']))
                                            {
                                                if($id_loai == $_GET['loaiuser'])
                                                    echo "<option value='$id_loai' selected>$tenloai1</option>";
                                                else
                                                    echo "<option value='$id_loai'>$tenloai1</option>";
                                            }                                                
                                            else
                                                echo "<option value='$id_loai'>$tenloai1</option>";
                                                
                                                
                                        }
                                        echo "<option value=''>Tất cả</option>";
                                    }

                                    ?>
                        </select>
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
                                href="http://localhost/admin/user.php?page=1<?php if(isset($_GET['hoten'])) echo "&hoten=".$_GET['hoten']; if(isset($_GET['loaiuser'])) echo "&loaiuser=".$_GET['loaiuser']; ?>"><span
                                    class="material-icons">arrow_back_ios</span></a>
                            <!-- Trang trước -->

                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/user.php?page=<?php echo $page_hientai - 1; ?><?php if(isset($_GET['hoten'])) echo "&hoten=".$_GET['hoten']; if(isset($_GET['loaiuser'])) echo "&loaiuser=".$_GET['loaiuser']; ?>"><span
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
                                href="http://localhost/admin/user.php?page=<?php echo $i; ?><?php if(isset($_GET['hoten'])) echo "&hoten=".$_GET['hoten']; if(isset($_GET['loaiuser'])) echo "&loaiuser=".$_GET['loaiuser']; ?>"><?php echo $i; ?></a>
                            <?php
                    }
                    ?>

                            <!-- Trang sau -->
                            <?php if ($page_hientai != $page) { ?>
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/user.php?page=<?php echo $page_hientai + 1; ?><?php if(isset($_GET['hoten'])) echo "&hoten=".$_GET['hoten']; if(isset($_GET['loaiuser'])) echo "&loaiuser=".$_GET['loaiuser']; ?>"><span
                                    class="material-icons">navigate_next</span></a>


                            <!-- Trang cuối    -->
                            <a style='padding:10px;<?php echo "color:black"; ?>'
                                href="http://localhost/admin/user.php?page=<?php echo $page; ?><?php if(isset($_GET['hoten'])) echo "&hoten=".$_GET['hoten']; if(isset($_GET['loaiuser'])) echo "&loaiuser=".$_GET['loaiuser']; ?>"><span
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
                            <th>Họ Và Tên</th>
                            <th>Email</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Loại User</th>
                            <th>Chỉnh Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if(mysqli_num_rows($ketqua1) > 0)
                                {
                                    
                                    while($row = mysqli_fetch_assoc($ketqua1))
                                    {
                                        $id_user        = $row['id_user'];
                                        $ho_user        = $row['ho_user'];
                                        $ten_user       = $row['ten_user'];
                                        $email          = $row['email_user'];
                                        $tendn          = $row['tendangnhap_user'];
                                        $tenloai_user   = $row['ten_loaiuser'];
                                        
                                        if($id_user != $_SESSION['id_user'])
                                        echo "
                                        <tr>
                                            <td>$id_user</td>
                                            <td width='250px'>$ho_user $ten_user</td>
                                            <td>$email</td>
                                            <td width='200px'>$tendn</td>
                                            <td>$tenloai_user</td>
                                            <td class='click' onclick='open_user_update($id_user)'>Chỉnh</td>
                                        </tr>";
                                        else
                                        echo "
                                        <tr>
                                            <td>$id_user</td>
                                            <td width='250px'>$ho_user $ten_user</td>
                                            <td>$email</td>
                                            <td width='200px'>$tendn</td>
                                            <td>$tenloai_user</td>
                                           
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
    <div id='update_loaiuser_data'></div>
</body>
<script src="../js/index.js"></script>
<script>
    function open_user_update(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('update_loaiuser_data').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', 'chucnang/update_loaiuser.php?id_user=' + id, true);
    xhttp.send();
}
</script>
</html>