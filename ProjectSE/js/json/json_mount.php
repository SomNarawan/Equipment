<?php
require "connectdb.php";
//คิวรี่ออกรายเดือน ประวัติการยืม !!
$mysql_qry = "*****";
$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result) > 0){
    while($e = mysqli_fetch_assoc($result)){
       $output["MOUNT"][] = $e;
    }
}else{
    $output["MOUNT"][] = null;
}
print(json_encode($output,JSON_UNESCAPED_UNICODE));
$conn->close();
?>