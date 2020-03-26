<?php
require "connectdb.php";

$year = $_GET['id_year'];
$mount = $_GET['id_mount'];
$type = $_GET['id_type'];

//-------------qry---ALL ยังใช้ได้อยู่ อัพเดต 25/3/63
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
    $mysql_qry_year = "SELECT t4.dateTime_b,t4.name_e as name_e_y ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_y FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year%' 
    GROUP BY t4.name_e
    ORDER BY t4.name_e";
}
else
{
    $mysql_qry_year = "SELECT t4.dateTime_b,t4.name_e as name_e_y ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_y FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year%' and users.role = '$type'
    GROUP BY t4.name_e,users.role
    ORDER BY t4.name_e";

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
    $mysql_qry_mount = "SELECT t4.dateTime_b,t4.name_e as name_e_m ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_m FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%'
    GROUP BY t4.name_e
    ORDER BY t4.name_e";
}
else
{
    $mysql_qry_mount = "SELECT t4.dateTime_b,t4.name_e as name_e_m ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_m FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%' and users.role = '$type'
    GROUP BY t4.name_e,users.role
    ORDER BY t4.name_e";
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

// ------------------------ >max 
if($type == 'a')
{
    $mysql_qry_max = "SELECT t4.dateTime_b,t4.name_e as name_e_max ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_max FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%' 
    GROUP BY t4.name_e
    ORDER BY numItem_max DESC";
}
else
{
    $mysql_qry_max = "SELECT t4.dateTime_b,t4.name_e as name_e_max ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_max FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%' and users.role = '$type'
    GROUP BY t4.name_e,users.role
    ORDER BY numItem_max DESC";
}

$result = mysqli_query($conn,$mysql_qry_max);
if(mysqli_num_rows($result) > 0)
    {
        while($e = mysqli_fetch_assoc($result))
        {
            $output["MAX"][] = $e;
        }
    }
else
    {
        $output["MAX"][] = null;
    }
//------------------------ >min
if($type == 'a')
{
    $mysql_qry_min = "SELECT t4.dateTime_b,t4.name_e as name_e_min ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_min FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%'
    GROUP BY t4.name_e
    ORDER BY numItem_min ";
}
else
{
    $mysql_qry_min = "SELECT t4.dateTime_b,t4.name_e as name_e_min ,t4.id_u,users.role , COUNT(t4.dateTime_b) as numItem_min FROM
    (SELECT t3.dateTime_b,t3.id_i,t3.name_e,t3.id_dc,t3.id_c,confirm.id_u FROM
    (SELECT t2.dateTime_b,t2.id_i,t2.name_e,t2.id_dc,detailconfirm.id_c FROM 
    (SELECT t1.dateTime_b,t1.id_i,equipment.name_e,t1.id_dc FROM (
    SELECT borrowing.dateTime_b,borrowing.id_i,item.id_e,borrowing.id_dc FROM borrowing JOIN item ON item.id_i = borrowing.id_i) AS T1 JOIN equipment ON t1.id_e = equipment.id_e)
    AS t2 JOIN detailconfirm ON detailconfirm.id_dc = t2.id_dc)
    AS t3 JOIN confirm ON confirm.id_c = t3.id_c)
    AS t4 JOIN users ON users.id_u = t4.id_u
    WHERE t4.dateTime_b LIKE '$year-$mount-%' and users.role = '$type'
    GROUP BY t4.name_e,users.role
    ORDER BY numItem_min ";
}

$result = mysqli_query($conn,$mysql_qry_min);
if(mysqli_num_rows($result) > 0)
    {
        while($e = mysqli_fetch_assoc($result))
        {
            $output["MIN"][] = $e;
        }
    }
else
    {
        $output["MIN"][] = null;
    }

print(json_encode($output,JSON_UNESCAPED_UNICODE));
$conn->close();

?>