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


<!-- -------------- content --------------- -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">จำนวนอุปกรณ์ทั้งหมด</h6>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChartAll"></canvas>
        </div>
        <hr>
        กำลังปรับปรุงหน้านี้อยู่ กรุณารอสักประเดี๋ยว <code>เข้าใจไหม</code> ขอบคุณ
    </div>
</div>
<!-- -------------- content 2--------------- -->
<!-- ต้องทำดรอปดาวลิส เลือกปีก่อน -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">สถิติรายปี</h6>
        <p>กรุณาเลือก ปี ที่ต้องการสืบค้นสถิติ
            <label for="Year"> : </lable>
                <select id="Year">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select></p>
        <p>กดปุ่มเพื่อดำเนินการ<button type="button" onclick="myFunction1()">ค้นหา</button></p>

        สถิติของปี : <p id="showYearAt1"> </p>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChartYear"></canvas>
        </div>
        <hr>
        ปี <code> ที่จะค้นหาเท่านั้น </code> นะ
    </div>
</div>

<!-- -------------- content 3--------------- -->
<!-- ดรอปดาวลิส เลือกปีแล้ว ถึงจะเลือกเดือนได้ -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">สถิติรายเดือน</h6>
        <p>กรุณาเลือก เดือน ที่ต้องการสืบค้นสถิติ จากปี : <p id="showYearAt2"> </p>
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
                </select></>
                <p>กดปุ่มเพื่อดำเนินการ<button type="button" onclick="myFunction2()">ค้นหา</button></p>
                สถิติของเดือน : <p id="showMountAt1"> </p>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChartMount"></canvas>
        </div>
        <hr>
        เดือน กรุณารอสักประเดี๋ยว <code>เข้าใจไหม</code> ขอบคุณ
    </div>
</div>
<script>
function myFunction1() {
    var getYear = document.getElementById("Year").value;
    document.getElementById("showYearAt1").innerHTML = getYear;
    document.getElementById("showYearAt2").innerHTML = getYear;
    sessionStorage.setItem("getYear",getYear );
    location.reload();
}
    _year = sessionStorage.getItem("getYear");
    document.getElementById("showYearAt1").innerHTML = _year;
    document.getElementById("showYearAt2").innerHTML = _year;
</script>
<script>
function myFunction2() {
    var getMount = document.getElementById("Mount").value;
    document.getElementById("showMountAt1").innerHTML = getMount;
    sessionStorage.setItem("getMount",getMount );
    location.reload();
}
    _mount = sessionStorage.getItem("getMount");
     document.getElementById("showMountAt1").innerHTML = _mount;
</script>

<?php
$content = ob_get_clean();

include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>