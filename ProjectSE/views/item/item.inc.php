<?php
try {
    if (!isset($_SESSION['member']) || !is_a($_SESSION['member'],"Member"))
    {
        header("Location: " . Router::getSourcePath() . "index.php");

    }

require_once Router::getSourcePath()."inc/helper_func.inc.php";

// เก็บข้อมูลจากสิ่งที่ controller เตรียมไว้ให้
//$products = $_SESSION['productList'];

// เริ่มต้นการเขียน view
$title = "Item";
ob_start();

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">อุปกรณ์ : <?php echo $name_e ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">จำนวนอุปกรณ์
                                (อุปกรณ์)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">5 อุปกรณ์</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" id="addItem" id_e="<?php echo $id_e; ?>" name_e="<?php echo $name_e; ?>"
                style="cursor:pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">เพิ่มอุปกรณ์</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus fa-2x text-green-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">อุปกรณ์</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>เลขครุภัณฑ์</th>
                                <th>รายละเอียด</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>เลขครุภัณฑ์</th>
                                <th>รายละเอียด</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>

                        </tfoot>
                        <tbody>

                            <?php
                            foreach ($itemList as $prod) { ?>
                            <tr>
                                <td><?= $prod->getId_i(); ?></td>
                                <td><?= $prod->getNote(); ?></td>
                                <td>
                                        <?php if($prod->getStatus_i() == 1)
                                    echo "<div style='color:green'>ยืมได้</div>";
                                if($prod->getStatus_i() == 2)
                                    echo "<a href='#'>ถูกยืม</a>";
                                if($prod->getStatus_i() == 3)
                                    echo "<div style='color:red'>ยืมไม่ได้</div>"; ?>
                                    </td>
                                <td>
                                    <button type="button" class="tt editItem btn btn-warning btn-sm"
                                        data-toggle="tooltip" titile=" แก้ไข"
                                        id="<?= $prod->getId_i(); ?>" id_i="<?= $prod->getId_i(); ?>"
                                            id_e="<?= $id_e; ?>" name_e="<?= $name_e; ?>" note="<?= $prod->getNote(); ?>"
                                            status_i="<?= $prod->getStatus_i(); ?>">
                                        <i class="fas fa-edit"></i></button>
                                    <button type="button" class="tt btn btn-danger btn-sm"
                                        onclick="delfunction('<?= $id_e; ?>','<?= $prod->getId_i(); ?>','<?= $name_e; ?>')" 
                                        data-toggle="tooltip" titile="ลบ"><i class="fas fa-trash"></i></button>
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
    include Router::getSourcePath()."views/item/ItemModal.inc.php"; 
$modal = ob_get_clean();

ob_start();
    echo "<script src='js/equipment/itemOperator.js'></script>";
$js = ob_get_clean();
include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>