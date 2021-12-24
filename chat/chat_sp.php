<?php
    session_start();
    include("../include/ketnoi.php");
?>
<?php
if($_POST['input_chat']!="")
{
    require __DIR__ . './../vendor/autoload.php';
    $id_user = $_SESSION['id_user'];
    $sql = "SELECT * FROM user WHERE id_user= $id_user";
    $row = mysqli_fetch_assoc(mysqli_query($ketnoi,$sql));
    $gioitinh = $row['gioitinh_user'];
    $nd      = $_POST['input_chat'];
    $anh_user= $_SESSION['anh_user'];
    $ten    =$_SESSION['ten_user'];
    $id_sp  = $_POST['id_sp'];
    $chat = [
        $id_user,
        $nd,
        $anh_user,
        $gioitinh,
        $ten
    ];
    
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        'fc27c62ee07a76c961f2',
        '4268d3cab499d7eda5e0',
        '1314889',
        $options
      );
    
      $pusher->trigger('my-channel', "sanpham$id_sp", $chat);
}

?>
<?php
    session_start();
    include("../include/ketnoi.php");
?>