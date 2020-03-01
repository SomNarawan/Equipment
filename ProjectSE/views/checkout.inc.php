<?php
try {
    if (!isset($_SESSION['member']) || !is_a($_SESSION['member'],"Member"))
    {
        header("Location: " . Router::getSourcePath() . "index.php");

    }

    require_once Router::getSourcePath()."inc/helper_func.inc.php";

// เก็บข้อมูลจากสิ่งที่ controller เตรียมไว้ให้
    $products = $_SESSION['productList'];
    $productNum = $_SESSION['productNum'];
    $subTotal = array();
    $priceNoVat = 0;
    $priceWithVat = 0;
    $vat = 0;
    $i = 0;
    foreach ($products as $prod) {

        $productPrice[$i] = $prod->getPrice();
        $i++;
    }

    calculateTotalPrice($productPrice,$productNum,$subTotal,$priceNoVat,$priceWithVat,$vat);

// เริ่มต้นการเขียน view
    $title = "Shopping Cart";
    ob_start();

    ?>

    <h1>รายการสั่งซื้อสินค้า</h1>
        <?php
        $header = array("ลำดับ","ชื่อสินค้า","ราคาต่อชิ้น (บาท)","จำนวน","ราคารวม");
        $data = array();
        $i = 0;
        foreach ($products as $prod) {
            if($productNum[$i] != 0)
                $data[$i] = array($i+1,$prod->getProductName(),$prod->getPrice(),$productNum[$i],$subTotal[$i]);
            $i++;
        }
        showTable($header,$data);
        ?>

    <table align="center" width="300">
        <tr>
            <td style="border:0;" align="center">ราคารวมทั้งหมด (excl. VAT)</td>
            <td style="border:0;"><?= $priceNoVat ?></td>
        </tr>
        <tr>
            <td style="border:0;" align="center">VAT (7%)</td>
            <td style="border:0;"><?= $vat ?></td>
        </tr>
        <tr>
            <td style="border:0;" align="center">ราคารวมทั้งหมด (incl. VAT)</td>
            <td style="border:0;"><?= $priceWithVat ?></td>
        </tr>
    </table>
    <br />
    <div align="center"><label>ขอบคุณที่ใช้บริการ...</label></div>
    <div align="center"><a href=<?= Router::getSourcePath() . "index.php?controller=Checkout&action=back" ?>>ย้อนกลับ</a></div>


    <?php
    $content = ob_get_clean();

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
