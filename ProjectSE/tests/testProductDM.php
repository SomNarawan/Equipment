<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 22/1/2562
 * Time: 16:46
 */
spl_autoload_register(function ($class) {
    $path = '../DAO/DataMapper/' . $class . '.class.php';
    if (file_exists($path))
        require_once $path;
});
spl_autoload_register(function ($class) {
    $path = '../DAO/' . $class . '.class.php';
    if (file_exists($path))
        require_once $path;
});



$products = new ProductMapper();

print_r($products->getAll());
echo "<br/>";
$p = $products->get(1);
print_r($p);
echo "<br/>";
$p->setProductName("ยาสีฟัน ตราคอลเกต");
$p->setPrice(50);
print_r($p);
echo "<br/>";
$products->update($p);

print_r($products->getAll());
echo "<br/>";

var_dump($products->get(40));

$p = new Product();
$p->setProductId(50);
$products->update($p);

