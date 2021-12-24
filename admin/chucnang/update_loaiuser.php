<?php 
include("../../include/chucnang.php");
if(isset($_POST['id_user1'])&&isset($_POST['loaiuser']))
{
    update_table("user","id_loaiuser",$_POST['loaiuser'],"id_user",$_POST['id_user1']);
    header("location: ../user.php");
}
if(isset($_GET['id_user'])){
    $id_user1 = $_GET['id_user'];
    $sql      = "SELECT * FROM user WHERE id_user = $id_user1";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $id_loaiuser = $row['id_loaiuser'];
    }
?>
<dialog id='update_user' open>
    <div class="dialog" >
        <div class="dialog-content" style='width:auto'>
            <div class="dialog-head" style='gap:20px'>
                <span class="font-shopee2021-bold" style='color:rgb(0,0,0,0.6)'>
                    <h4 style='font-size:1em'>CẬP NHẬT LOẠI USER</h4>
                </span>
                <button onclick="close_dialog('update_user')" style='display:flex;align-items:center'
                    class="btn bg-brown font-white"><span class="material-icons">close</span></button>
            </div>
            <form class="dialog-body" action="chucnang/update_loaiuser.php" method="post">
                <input type="text" style='display:none' name='id_user1' value="<?php echo $id_user1; ?>">
                        <span class="form-title">Loại user</span>
                        <select class="input-form" name="loaiuser" id="" style='color:black'>
                                <?php 
                                $sql      = 'SELECT * FROM loaiuser';
                                $ketqua   = mysqli_query($ketnoi,$sql);
                                if(mysqli_num_rows($ketqua)>0)
                                {
                                    while($row = mysqli_fetch_assoc($ketqua))
                                    {
                                        $id_loai = $row['id_loaiuser'];
                                        $tenloai1 = $row['ten_loaiuser'];
                                        if($id_loai == $id_loaiuser)
                                        {
                                                echo "<option value='$id_loai' selected>$tenloai1</option>";
                                        }
                                            
                                        else
                                        {
                                                echo "<option value='$id_loai'>$tenloai1</option>";
                                        }
                                            
                                    }
                                }

                                ?>
                        </select>
                        <div class="error">

                        </div>
                
                <div>
                    <button type="submit" name='btn-submit' class='login-btn font-shopee2021-bold bg-brown'>CẬP NHẬT LOẠI USER</button>
                </div>
            </form>
            <div class="dialog-head">

            </div>
        </div>
    </div>
</dialog>
<?php } ?>