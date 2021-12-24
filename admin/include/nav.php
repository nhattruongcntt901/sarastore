<div class="nav-item <?php if(isset($index)) echo "active-item"; ?>" onclick="location.href='index.php'">
    <span class="material-icons-outlined">home</span>
    <span>TRANG CHỦ</span>
</div>
<?php if($_SESSION['id_loaiuser'] == 5){ ?>
<div class="nav-item <?php if(isset($user)) echo "active-item"; ?>" onclick="location.href='user.php'">
    <span class="material-icons-outlined">home</span>
    <span>USER</span>
</div>
<?php } ?>
<?php if($_SESSION['id_loaiuser'] == 5 || $_SESSION['id_loaiuser'] == 4){ ?>
<div class="nav-item <?php if(isset($sanpham)) echo "active-item"; ?>" onclick="location.href='sanpham.php'">
    <span class="material-icons-outlined">home</span>
    <span>SẢN PHẨM</span>
</div>
<?php } ?>
<?php if($_SESSION['id_loaiuser'] == 5 || $_SESSION['id_loaiuser'] == 4 || $_SESSION['id_loaiuser'] == 3){ ?>
<div class="nav-item <?php if(isset($donhang)) echo "active-item"; ?>" onclick="location.href='donhang.php'">
    <span class="material-icons-outlined">home</span>
    <span>ĐƠN HÀNG</span>
</div>
<?php } ?>
<?php if($_SESSION['id_loaiuser'] == 5){ ?>
<div class="nav-item <?php if(isset($doanhso)) echo "active-item"; ?>" onclick="location.href='doanhso.php'">
    <span class="material-icons-outlined">home</span>
    <span>DOANH SỐ</span>
</div>
<?php } ?>