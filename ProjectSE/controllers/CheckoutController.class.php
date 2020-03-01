<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:07
 */

class checkoutController {

    public function handleRequest(string $action="index", array $params) {
        switch ($action) {
            case "cal":
                $this->$action($params);
                break;
            case "back":
                $this->$action();
            case "index":
                $this->index();
                break;
            default:
                break;
        }

    }

    private function cal(array $params) {
        if ($params !== null){
        $productNum = array();
        for($i=0;$i<sizeof($params['POST'])-1;$i++){

            $productNum[$i]=$params['POST']['prod_'.$i];
        }
            session_start();
            $_SESSION['productNum'] = $productNum;
            include Router::getSourcePath()."views/checkout.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }

    private function back(){
        session_start();
        include Router::getSourcePath()."views/cart.inc.php";
    }
    // ควรมีสำหรับ controller ทุกตัว
    private function index() {

    }

}