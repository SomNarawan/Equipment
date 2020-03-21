<?php
require "connectdb.php";

$year = $_GET['id_year'];
$mount = $_GET['id_mount'];

//-------------qry---ALL
$mysql_qry = "SELECT equipment.name_e,COUNT(item.id_i) as numItem 
            FROM equipment JOIN item 
            WHERE item.id_e = equipment.id_e 
            GROUP BY equipment.name_e";

$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result) > 0)
    {
        while($e = mysqli_fetch_assoc($result))
        {
            $output["ALL"][] = $e;
        }
    }
else
    {
        $output["ALL"][] = null;
    }

//-------------qry---YEAR

$mysql_qry_year = "SELECT t1.mountBorrow,COUNT(t1.mountBorrow) as numItem_y,t1.id_equip ,equipment.name_e as name_e_y FROM(SELECT borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
        FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
        JOIN equipment ON equipment.id_e = t1.id_equip
        WHERE t1.mountBorrow LIKE '$year%'
        GROUP BY equipment.name_e";

$result = mysqli_query($conn,$mysql_qry_year);
if(mysqli_num_rows($result) > 0)
    {
        while($e = mysqli_fetch_assoc($result))
        {
            $output["YEAR"][] = $e;
        }
    }
else
    {
        $output["YEAR"][] = null;
    }
    
//-------------qry---MOUNT

$mysql_qry_mount = "SELECT t1.mountBorrow,COUNT(t1.mountBorrow) as numItem_m ,t1.id_equip ,equipment.name_e as name_e_m FROM(SELECT borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
        FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
        JOIN equipment ON equipment.id_e = t1.id_equip
        WHERE t1.mountBorrow LIKE '$year%' AND t1.mountBorrow LIKE '%-$mount-%'
        GROUP BY equipment.name_e";

$result = mysqli_query($conn,$mysql_qry_mount);
if(mysqli_num_rows($result) > 0)
    {
        while($e = mysqli_fetch_assoc($result))
        {
            $output["MOUNT"][] = $e;
        }
    }
else
    {
        $output["MOUNT"][] = null;
    }


print(json_encode($output,JSON_UNESCAPED_UNICODE));
$conn->close();

?>