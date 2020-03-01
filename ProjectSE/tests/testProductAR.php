<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:52
 */
spl_autoload_register(function ($class) {
    $path = '../DAO/ActiveRecord/' . $class . '.class.php';
    if (file_exists($path))
        require_once $path;
});
spl_autoload_register(function ($class) {
    $path = '../DAO/' . $class . '.class.php';
    if (file_exists($path))
        require_once $path;
});

$list = Product::findAll();
print_r($list);
echo "<br/>";


$product = new Product();
//$product->setProductId(5);
$product->setProductName("แปรง");
$product->setPrice(30);
$product->insert();
$product->setPrice(40);
$product->update();

$p = Product::findById(2);
print_r($p);

var_dump(Product::findById(30));