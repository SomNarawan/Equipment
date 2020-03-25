<?php
try {
    if (!isset($_SESSION['member']) || !is_a($_SESSION['member'],"Member"))
    {
        header("Location: " . Router::getSourcePath() . "index.php");

    }

require_once Router::getSourcePath()."inc/helper_func.inc.php";

// เก็บข้อมูลจากสิ่งที่ controller เตรียมไว้ให้
// $products = $_SESSION['productList'];

// เริ่มต้นการเขียน view
$title = "Borrowing";
ob_start();

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">การยืมทั้งหมด</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">จำนวนอุปกรณ์ที่ถูกยืม
                                (ชิ้น)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4 ชิ้น</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">จำนวนคนยืม
                                (คน)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3 คน</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" id="addBorrowOpeType" style="cursor:pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">เพิ่มการยืม</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus fa-2x text-green-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">การยืมอุปกรณ์</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>อุปกรณ์</th>
                                <th>เลขครุภัณฑ์</th>
                                <th>วันที่ยืม-เวลาที่ยืม</th>
                                <th>วันที่คืน-เวลาที่คืน</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>อุปกรณ์</th>
                                <th>เลขครุภัณฑ์</th>
                                <th>วันที่ยืม-เวลาที่ยืม</th>
                                <th>วันที่คืน-เวลาที่คืน</th>
                                <th>จัดการ</th>
                            </tr>

                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($borrowList as $prod) { 
                                $id_b =$prod->getId_b();
                                $id_e =$prod->getId_e();
                                $id_i =$prod->getId_i();
                                $name_e = $prod->getName_e();
                                ?>
                            <tr>
                                <td><?= $prod->getUsername(); ?></td>
                                <td><?= $prod->getTitile()." ".$prod->getName()." ".$prod->getSurname(); ?></td>
                                <td><?= $prod->getName_e(); ?></td>
                                <td><?= $prod->getId_i(); ?>
                                    <?php  if($prod->getId_i() != null){ ?>
                                    <button type="button" class="btn btn-warning btn-sm editId_i" data-toggle="tooltip"
                                        titile="แก้ไข" id_b='<?= $id_b; ?>' id_e='<?= $id_e; ?>' 
                                        name_e = '<?= $prod->getName_e(); ?>' id_i = <?= $id_i; ?>>
                                        <i class="fas fa-edit"></i></button>
                                    <?php } ?>

                                </td>
                                <td><?php
                                if($prod->getDateTime_b() == null){
                                    echo "<button type='button' class='btn btn-success getEquipment' id_b='$id_b' id_e='$id_e' 
                                    name_e = '$name_e' style='width:150px;'>มารับของ</button>"; 
                                }else
                                    echo $prod->getDateTime_b();?></td>
                                <td><?php
                                if($prod->getDateTime_r() == null){
                                    if($prod->getId_i() == null){
                                        echo "<button type='button' disabled class='btn btn-primary returnEquipment' id_b='$id_b' id_e='$id_e'
                                        name_e = '$name_e' style='width:150px;'>มาคืนของ</button>"; 
                                    }else{
                                        echo "<button type='button' class='btn btn-primary returnEquipment' id_b='$id_b' id_e='$id_e'
                                        name_e = '$name_e' id_i = '$id_i' style='width:150px;'>มาคืนของ</button>"; 
                                    }
                                   
                                }else
                                    echo $prod->getDateTime_r();?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip"
                                        titile="รายละเอียด"><i class="fas fa-list"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                        titile="ลบ"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?php
$content = ob_get_clean();
ob_start();
    include Router::getSourcePath()."views/borrowing/borrowingOperationModal.inc.php"; 
$modal = ob_get_clean();

ob_start();
    echo "<script src='js/equipment/borrowingOperation.js'></script>";
$js = ob_get_clean();
include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>