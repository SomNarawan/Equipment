<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:13
 */

class IndexController {

    public function handleRequest(string $action="index", array $params=null) {
        $this->$action();
    }


    private function index() {
        include Router::getSourcePath()."views/login.inc.php";
    }

}