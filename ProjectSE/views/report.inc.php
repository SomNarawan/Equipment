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

<h1 class="h3 mb-0 text-gray-800"> History Chart</h1>
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Group (กลุ่มที่ต้องการสืบค้น)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><p>กรุณาเลือก กลุ่ม ในการสืบค้นสถิติ
                        <label for="typeUser"> : </lable>
                        <select id="typeUser">
                            <option value="a">ผู้ใช้งานทั้งหมด</option>
                            <option value="s">นักศึกษา</option>
                            <option value="t">อาจารย์</option>
                            <option value="o">เจ้าหน้าที่</option>
                        </select></p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Year (ปีที่ต้องการสืบค้น)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><p>กรุณาเลือก ปี ในการสืบค้นสถิติ
                        <label for="Year"> : </lable>
                        <select id="Year">
                            <option value="2020">ปี 2563</option>
                            <option value="2019">ปี 2562</option>
                            <option value="2018">ปี 2561</option>
                        </select></p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mount (เดือนที่ต้องการสืบค้น)</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><p>กรุณาเลือก เดือน ในการสืบค้นสถิติ
                        <label for="Mount"> : </lable>
                        <select id="Mount">
                            <option value="01">(1) January</option>
                            <option value="02">(2) February</option>
                            <option value="03">(3) March</option>
                            <option value="04">(4) April</option>
                            <option value="05">(5) May</option>
                            <option value="06">(6) June</option>
                            <option value="07">(7) July</option>
                            <option value="08">(8) August</option>
                            <option value="09">(9) September</option>
                            <option value="10">(10) October</option>
                            <option value="11">(11) November</option>
                            <option value="12">(12) December</option>
                        </select></p>
                                </div>
                            </div>
                            <div class="col">
                                <!-- <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> -->
                            </div>
                        </div>
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
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">DISPLAY HISTORY INFO :</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <p>กดปุ่มเพื่อดำเนินการ <button type="button" onclick="myFunction()">ค้นหา</button></p>
                         กลุ่มค้นหา :<p id="showTypeAt1" > </p>
                         สถิติของปี :<p id="showYearAt1" > </p>
                         สถิติของเดือน :<p id="showMountAt1" > </p>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -------------- content --------------- -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">จำนวนอุปกรณ์ทั้งหมด</h6>
        <div class="topbar-divider d-none d-sm-block"></div>

        </ul>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChartAll"></canvas>
        </div>
        <hr>
        จำนวนชนิดสิ่งของที่มี <code> ทั้งหมด </code> ****
    </div>

</div>
<!-- -------------- content 2--------------- -->
<!-- ต้องทำดรอปดาวลิส เลือกปีก่อน -->
<div class="row">
    <div class="col-xl-6 col-md-6 mb-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">สถิติรายปี</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChartYear"></canvas>
                </div>
                <hr>
                ประวัติการยืม <code> รายปี </code> 
            </div>
        </div>
    </div>
    <!-- -------------- content 3--------------- -->
    <!-- ดรอปดาวลิส เลือกปีแล้ว ถึงจะเลือกเดือนได้ -->
    <div class="col-xl-6 col-md-6 mb-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">สถิติรายเดือน</h6>

            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChartMount"></canvas></div>
                <hr>
                ประวัติการยืม  <code>รายเดือน</code> จากในปีที่ค้นหา
            </div>
        </div>
    </div>
</div>
</div>
<!-- -------------- content 4 HIGH --------------- -->
<div class="row">
    
    <div class="col-xl-6 col-md-6 mb-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">สถิติประวัติการยืมสูงสุด-ต่ำสุด</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChartHigh"></canvas>
                </div>
                <hr>
                Top <code> ยืมสูงสุด </code> x ตัว
            </div>
        </div>
    </div>
    
    <!-- LOW -->
    <div class="col-xl-6 col-md-6 mb-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">สถิติประวัติการยืมต่ำสุด-สูงสุด</h6>

            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChartLow"></canvas></div>
                <hr>
                Top  <code> ยืมสูงสุด </code> x ตัว
            </div>
        </div>
    </div>
</div>
</div>
<script>
function myFunction() {
    var getYear = document.getElementById("Year").value;
    var getMount = document.getElementById("Mount").value;
    var getType = document.getElementById("typeUser").value;
    sessionStorage.setItem("getYear", getYear);
    sessionStorage.setItem("getMount", getMount);
    sessionStorage.setItem("getType", getType);
    location.reload();
}
_year = sessionStorage.getItem("getYear");
_mount = sessionStorage.getItem("getMount");
_type = sessionStorage.getItem("getType");
document.getElementById("showYearAt1").innerHTML = _year;

if(_mount == '01')
    document.getElementById("showMountAt1").innerHTML = "มกราคม";
else if(_mount == '02')
    document.getElementById("showMountAt1").innerHTML = "กุมภาพันธ์";
else if(_mount == '03')
    document.getElementById("showMountAt1").innerHTML = "มีนาคม";
else if(_mount == '04')
    document.getElementById("showMountAt1").innerHTML = "เมษาคม";
else if(_mount == '05')
    document.getElementById("showMountAt1").innerHTML = "พฤษภาคม";
else if(_mount == '06')
    document.getElementById("showMountAt1").innerHTML = "มิถุนาคม";
else if(_mount == '07')
    document.getElementById("showMountAt1").innerHTML = "กรกฎาคม";
else if(_mount == '08')
    document.getElementById("showMountAt1").innerHTML = "สิงหาคม";
else if(_mount == '09')
    document.getElementById("showMountAt1").innerHTML = "กันยายน";
else if(_mount == '10')
    document.getElementById("showMountAt1").innerHTML = "ตุลาคม";
else if(_mount == '11')
    document.getElementById("showMountAt1").innerHTML = "พฤศจิกายน";
else if(_mount == '12')
    document.getElementById("showMountAt1").innerHTML = "ธันวาคม";
else
    document.getElementById("showMountAt1").innerHTML = "เกิดข้อผิดพลาด ไม่สามารถระบุเดือนได้";

if (_type == 'a')
    document.getElementById("showTypeAt1").innerHTML = "ผู้ใช้ทั้งหมด";
else if (_type == 's')
    document.getElementById("showTypeAt1").innerHTML = "นักศึกษา";
else if (_type == 't')
    document.getElementById("showTypeAt1").innerHTML = "อาจารย์";
else if (_type == 'o')
    document.getElementById("showTypeAt1").innerHTML = "เจ้าหน้าที่";
else
    document.getElementById("showTypeAt1").innerHTML = "เกิดข้อผิดพลาด ไม่สามารถระบุหมวดผู้ใช้งาน";

</script>



<?php
$content = ob_get_clean();

include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>