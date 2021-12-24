<?php
session_start();
$id_sp = $_GET['id_sp'];

foreach($_SESSION['cart'] as $key => $value)
{
    if($value==$id_sp)
    {
        array_splice($_SESSION['cart'], $key, 1);
        break;
    }
}
header("location: ../../../cart");

?>