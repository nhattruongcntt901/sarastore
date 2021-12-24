<?php 
session_start();
error_reporting(0);
if(isset($_GET['id_sp']))
{
    $id_sp = $_GET['id_sp'];
    $add = true;
    foreach($_SESSION['cart'] as $value)
    {
        if($value == $id_sp)
            $add = false;
    }
    if(!isset($_SESSION['id_user']))
    {
      ?>
        <div style='position:fixed;z-index:2000;top:100px;width:60%;display:flex;justify-content:center'>
              <div id='animate' class="bg-warning font-shopee2021-bold animate__animated animate__bounceInDown" style="padding:10px;border-radius:5px">Vui lòng đăng nhập</div>
          </div>
      <?php
    }
    else
    {

      if($add==true)
      {
          array_push($_SESSION['cart'],$id_sp);
          ?>
      <div style='position:fixed;z-index:2000;top:100px;width:60%;display:flex;justify-content:center'>
          <div id='animate' class="bg-warning font-shopee2021-bold animate__animated animate__bounceInDown" style="padding:10px;border-radius:5px">Thêm vào giỏ hàng thành công</div>
      </div>
      <?php
      }
      else
      {
          ?>

      <div style='position:fixed;z-index:2000;top:100px;width:60%;display:flex;justify-content:center'>
          <div id='animate' class="bg-warning font-shopee2021-bold animate__animated animate__bounceInDown" style="padding:10px;border-radius:5px">Sản phẩm này đã được thêm vào giỏ hàng rồi</div>
      </div>
      <?php
      }
    }
}

 ?>  


<?php
  require __DIR__ . '../../../../vendor/autoload.php';

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

  $data = count($_SESSION['cart']);
  $pusher->trigger('my-channel', 'cart', $data);
?>