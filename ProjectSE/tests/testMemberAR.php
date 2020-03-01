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

$list = Member::findAll();
print_r($list);
echo "<br/>";


$member = new Member();
//$product->setProductId(5);
$member->setName("Judy");
$member->setSurname("Gee");
$member->insert();
$member->setUsername("Jd");
$member->update();

$m = Member::findById(3);
print_r($m);

var_dump(Member::findById(3));