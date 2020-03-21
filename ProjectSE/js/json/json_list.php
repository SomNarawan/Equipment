<?php
require "connectdb.php";

//$id_doc = 2 ;

$mysql_qry = "SELECT equipment.name_e,COUNT(item.id_i) as numItem 
            FROM equipment JOIN item 
            WHERE item.id_e = equipment.id_e 
            GROUP BY equipment.name_e";

$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result) > 0){
    while($e = mysqli_fetch_assoc($result)){
       $output["ALL"][] = $e;
    }
}else{
    $output["ALL"][] = null;
}
print(json_encode($output,JSON_UNESCAPED_UNICODE));
$conn->close();

?>