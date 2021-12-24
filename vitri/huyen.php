<?php
include("../include/ketnoi.php");
if(isset($_GET['idtinh']))
{
    $id = $_GET['idtinh'];
    $sql = "SELECT * FROM district Where _province_id = $id Order by _name ASC";

    $ketqua = mysqli_query($ketnoi1,$sql);

    if(mysqli_num_rows($ketqua) > 0)
	{
        echo "<option selected disabled>Chọn Huyện/Thành Phố</option>";
		while ($row = mysqli_fetch_assoc($ketqua))
		{
            $tenhuyen = $row['_name'];
            $idhuyen = $row['id'];
            echo "<option value='$idhuyen'>$tenhuyen</option>";
        }
    }
}
?>