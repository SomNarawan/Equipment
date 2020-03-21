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
$title = "Type";
ob_start();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">หมวดอุปกรณ์</h1>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">จำนวนหมวดอุปกรณ์
                                (หมวด)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2 หมวด</div>
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
            <div class="card border-left-success shadow h-100 py-2" id="addType" style="cursor:pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">เพิ่มหมวดอุปกรณ์</div>
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
                <h6 class="m-0 font-weight-bold text-primary">หมวดอุปกรณ์</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>จำนวนอุปกรณ์</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>จำนวนอุปกรณ์</th>
                                <th>จัดการ</th>
                            </tr>

                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($typeList as $prod) { ?>
                            <tr>
                                <td><?= $prod->getName_t(); ?></td>
                                <td><?= $prod->getNote(); ?></td>
                                <td><a href="#"><?= $prod->getCount_equipment(); ?></a></td>
                                <td>
                                <button type="button" class="tt editType btn btn-info btn-sm" data-toggle="tooltip" id="<?= $prod->getId_t(); ?>" 
                                id_t = "<?= $prod->getId_t(); ?>" name_t="<?= $prod->getName_t(); ?>" note="<?= $prod->getNote(); ?>" titile="รายละเอียด"><i class=" fas fa-list"></i></button>
                                <button type="button" class="tt btn btn-danger btn-sm" onclick="delfunction('<?= $prod->getName_t(); ?>','<?= $prod->getId_t(); ?>')"
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
    include Router::getSourcePath()."views/type/typeModal.inc.php"; 
$modal = ob_get_clean();

ob_start();
    echo "<script src='js/equipment/type.js'></script>";
$js = ob_get_clean();
include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>
<?php
/*echo "<hr/>";
echo "<pre><code>";
show_source(__FILE__);
echo "</code></pre>";*/