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



$members = new MemberMapper();

print_r($members->getAll());
echo "<br/>";
$m = $members->get(4);
print_r($m);
echo "<br/>";
$m->setUsername("Kit");
$m->setpasswd("112233");
$m->setSurname("Hit");
print_r($m);
echo "<br/>";
$members->update($m);

print_r($members->getAll());
echo "<br/>";

var_dump($members->get(4));

