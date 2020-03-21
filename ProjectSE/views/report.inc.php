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
        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
        </div>
        <hr>
        Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file.
    </div>
</div>



<?php
$content = ob_get_clean();

include Router::getSourcePath()."templates/layout.php";
} catch (Throwable $e) { // PHP 7++
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>