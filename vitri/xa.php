<?php
include("../include/ketnoi.php");
if(isset($_GET['idhuyen']))
{
    $id = $_GET['idhuyen'];
    $sql = "SELECT * FROM ward Where _district_id = $id Order by _name ASC";

    $ketqua = mysqli_query($ketnoi1,$sql);

    if(mysqli_num_rows($ketqua) > 0)
	{
        echo "<option selected disabled>Chọn Xã/Phường</option>";
		while ($row = mysqli_fetch_assoc($ketqua))
		{
            $tenxa = $row['_name'];
            $idxa = $row['id'];
            echo "<option value='$idxa'>$tenxa</option>";
        }
    }
}
?>