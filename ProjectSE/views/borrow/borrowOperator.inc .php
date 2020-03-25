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
$title = "Borrow";
ob_start();

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ยืมอุปกรณ์</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

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
                                <th>จำนวน(ชิ้น)</th>
                                <th>วันที่ยืม   เวลาที่ยืม</th>
                                <th>วันที่คืน   เวลาที่คืน</th>
                                <th>จำนวนวัน</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>อุปกรณ์</th>
                                <th>เลขครุภัณฑ์</th>
                                <th>จำนวน(ชิ้น)</th>
                                <th>วันที่ยืม   เวลาที่ยืม</th>
                                <th>วันที่คืน   เวลาที่คืน</th>
                                <th>จำนวนวัน</th>
                                <th>จัดการ</th>
                            </tr>

                        </tfoot>
                        <tbody>
                            <tr>
                                <td>b602050xxxx</td>
                                <td>น.ส.นัก เรียน</td>
                                <td>เมาส์</td>
                                <td>M0001
                                <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" titile="แก้ไข"><i class="fas fa-edit"></i></button>
                                </td>
                                <td><a href="#">1</a></td>
                                <td>17/ม.ค./63  13.21</td>
                                <td></td>
                                <td><a href="#">43</a></td>
                                <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" titile="รายละเอียด"><i class="fas fa-list"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" titile="ลบ"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>b602050xxxx</td>
                                <td>น.ส.นัก เรียน</td>
                                <td>android</td>
                                <td>-</td>
                                <td><a href="#">1</a></td>
                                <td></td>
                                <td></td>
                                <td><a href="#">0</a></td>
                                <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" titile="รายละเอียด"><i class="fas fa-list"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" titile="ลบ"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>officer 1</td>
                                <td>น.ส.พนัก งาน</td>
                                <td>จอ</td>
                                <td>I0001
                                <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" titile="แก้ไข"><i class="fas fa-edit"></i></button>
                                </td>
                                <td><a href="#">2</a></td>
                                <td>3/ก.พ./63  09.40</td>
                                <td>6/ก.พ./63  14.05</td>
                                <td><a href="#">3</a></td>
                                <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" titile="รายละเอียด"><i class="fas fa-list"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" titile="ลบ"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            
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

include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>