<?php
if(!isset($_SESSION['id_user']))
{   
    header("location: https://localhost/");
    die();
}
?>