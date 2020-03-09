<?php
try {
    if (!isset($_SESSION['member']) || !is_a($_SESSION['member'],"Member"))
    {
        header("Location: " . Router::getSourcePath() . "index.php");

    }

require_once Router::getSourcePath()."inc/helper_func.inc.php";

// เก็บข้อมูลจากสิ่งที่ controller เตรียมไว้ให้
$products = $_SESSION['productList'];

// เริ่มต้นการเขียน view
$title = "Type";
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
                <h6 class="m-0 font-weight-bold text-primary">ยืมอุปกรณ์</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>อุปกรณ์</th>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>คงเหลือ</th>
                                <th>จำนวน(ชิ้น)</th>
                                <th>เพิ่มการยืมอุปกรณ์</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>อุปกรณ์</th>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>คงเหลือ</th>
                                <th>จำนวน(ชิ้น)</th>
                                <th>เพิ่มการยืมอุปกรณ์</th>
                            </tr>

                        </tfoot>
                        <tbody>
                            <tr>
                                <td>เมาส์</td>
                                <td>คอมพิวเตอร์</td>
                                <td>Logitec</td>
                                <td><a href="#">3</a></td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-success" style="width:150px;">เพิ่ม</button></td>
                            </tr>
                            <tr>
                                <td>จอ</td>
                                <td>คอมพิวเตอร์</td>
                                <td>DELL</td>
                                <td><a href="#">5</a></td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-success" style="width:150px;">เพิ่ม</button></td>
                            </tr>
                            <tr>
                                <td>โน๊ตบุ๊ค</td>
                                <td>คอมพิวเตอร์</td>
                                <td>ACER</td>
                                <td><a href="#">6</a></td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-success" style="width:150px;">เพิ่ม</button></td>
                            </tr>
                            <tr>
                                <td>android</td>
                                <td>โทรศัพท์</td>
                                <td>OPPO A 38</td>
                                <td><a href="#">3</a></td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-success" style="width:150px;">เพิ่ม</button></td>
                            </tr>
                            <tr>
                                <td>IOS/td>
                                <td>โทรศัพท์</td>
                                <td>Iphone 6</td>
                                <td><a href="#">2</a></td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-success" style="width:150px;">เพิ่ม</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">อุปกรณ์ที่ทำการยืม</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>อุปกรณ์</th>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>จำนวน(ชิ้น)</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>อุปกรณ์</th>
                                <th>หมวดอุปกรณ์</th>
                                <th>รายละเอียด</th>
                                <th>จำนวน(ชิ้น)</th>
                                <th>จัดการ</th>
                            </tr>

                        </tfoot>
                        <tbody>
                            <tr>
                                <td>เมาส์</td>
                                <td>คอมพิวเตอร์</td>
                                <td>Logitec</td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-danger" style="width:150px;">ลบ</button></td>
                            </tr>
                            <tr>
                                <td>android</td>
                                <td>โทรศัพท์</td>
                                <td>OPPO A 38</td>
                                <td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0'/></td>
                                <td><button type="button" class="btn btn-danger" style="width:150px;">ลบ</button></td>
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