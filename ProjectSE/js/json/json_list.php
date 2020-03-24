<?php
require "connectdb.php";

$year = $_GET['id_year'];
$mount = $_GET['id_mount'];
$type = $_GET['id_type'];

//-------------qry---ALL
$mysql_qry = "SELECT equipment.name_e,COUNT(item.id_i) as numItem 
            FROM equipment JOIN item 
            WHERE item.id_e = equipment.id_e 
            GROUP BY equipment.name_e
            ORDER BY equipment.name_e";

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

if( $type == 'a')
{
    $mysql_qry_year = "SELECT t2.mountBorrow,COUNT(t2.mountBorrow) as numItem_y ,t2.id_equip,t2.name_e as name_e_y ,user.role  FROM(SELECT t1.mountBorrow ,t1.id_equip ,equipment.name_e,t1.id_u FROM(SELECT borrowing.id_u,borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
JOIN equipment ON equipment.id_e = t1.id_equip ) as t2 JOIN user ON user.id_u = t2.id_u
WHERE t2.mountBorrow LIKE '$year%'
GROUP BY t2.name_e
ORDER BY t2.name_e";
}
else
{
    $mysql_qry_year = "SELECT t2.mountBorrow,COUNT(t2.mountBorrow) as numItem_y ,t2.id_equip , t2.name_e as name_e_y ,user.role  FROM(SELECT t1.mountBorrow ,t1.id_equip ,equipment.name_e,t1.id_u FROM(SELECT borrowing.id_u,borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
JOIN equipment ON equipment.id_e = t1.id_equip ) as t2 JOIN user ON user.id_u = t2.id_u
WHERE t2.mountBorrow LIKE '$year%' and user.role = '$type' 
GROUP BY t2.name_e
ORDER BY t2.name_e";

}

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

if($type == 'a')
{
$mysql_qry_mount = "SELECT t2.mountBorrow,COUNT(t2.mountBorrow) as numItem_m ,t2.id_equip,t2.name_e as name_e_m ,user.role FROM(SELECT t1.mountBorrow ,t1.id_equip ,equipment.name_e,t1.id_u FROM(SELECT borrowing.id_u,borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
              FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
              JOIN equipment ON equipment.id_e = t1.id_equip ) as t2 JOIN user ON user.id_u = t2.id_u
              WHERE t2.mountBorrow LIKE '$year-$mount-%' 
              GROUP BY t2.name_e
	      	  ORDER BY t2.name_e";
}
else
{
    $mysql_qry_mount = "SELECT t2.mountBorrow,COUNT(t2.mountBorrow) as numItem_m ,t2.id_equip,t2.name_e as name_e_m ,user.role FROM(SELECT t1.mountBorrow ,t1.id_equip ,equipment.name_e,t1.id_u FROM(SELECT borrowing.id_u,borrowing.dateTime_b as mountBorrow,item.id_e as id_equip 
    FROM borrowing JOIN item ON item.id_i = borrowing.id_i )AS t1
    JOIN equipment ON equipment.id_e = t1.id_equip ) as t2 JOIN user ON user.id_u = t2.id_u
    WHERE t2.mountBorrow LIKE '$year-$mount-%' and user.role = '$type'
    GROUP BY t2.name_e
    ORDER BY t2.name_e";
}

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