<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:07
 */

class MemberController {

    /**
     * handleRequest จะทำการตรวจสอบ action และพารามิเตอร์ที่ส่งเข้ามาจาก Router
     * แล้วทำการเรียกใช้เมธอดที่เหมาะสมเพื่อประมวลผลแล้วส่งผลลัพธ์กลับ
     *
     * @param string $action ชื่อ action ที่ผู้ใช้ต้องการทำ
     * @param array $params พารามิเตอร์ที่ใช้เพื่อในการทำ action หนึ่งๆ
     */
    public function handleRequest(string $action="index", array $params) {
        switch ($action) {
            case "login":
                $username = $params["POST"]["username"]??"";
                $pass = $params["POST"]["password"]??"";
                if ($username !== "" && $pass !== "") {
                    $this->$action($username, $pass);
                }
                break;
            case "logout":
                $this->$action();
            case "menu_type":
            case "menu_equipmentO":
            case "menu_equipmentST":
            case "menu_borrowingO":
            case "menu_borrowOT":
            case "menu_borrowS":
            case "menu_borrowingST":
            case "menu_report":
            case "menu_confirm":
            case "menu_borrow":
                $this->$action();
            case "index":
                $this->index();
                break;
            default:
                break;
        }

    }
    private function menu_borrow(){
        session_start();
        if ($_SESSION['member'] !== null){
            unset($_SESSION['equipment_borrow']);
            $equipmentList = Equipment::findAll();
            include Router::getSourcePath()."views/borrow/borrow.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_report(){
        session_start();
        if ($_SESSION['member'] !== null){
            include Router::getSourcePath()."views/report.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_confirm(){
        session_start();
        if ($_SESSION['member'] !== null){
            // print_r($_SESSION['member']);
            $count_student = Confirm::Count_student($_SESSION['member']->getId_u());
            $count_confirm = Confirm::Count_confirm($_SESSION['member']->getId_u());
            $confirmList = Confirm::findAll($_SESSION['member']->getId_u());
            // print_r($confirmList);
            include Router::getSourcePath()."views/confirm/confirm.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_borrowS(){
        session_start();
        if ($_SESSION['member'] !== null){
            include Router::getSourcePath()."views/borrow/borrow.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_borrowOT(){
        session_start();
        if ($_SESSION['member'] !== null){

            $equipmentList = Equipment::findAll();
            include Router::getSourcePath()."views/borrow/borrowOperator.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_borrowingST(){
        session_start();
        if ($_SESSION['member'] !== null){

            $count_equipment = Borrowing::Count_equipment($_SESSION['member']->getId_u());
            $borrowingList = Borrowing::FindAll($_SESSION['member']->getId_u());
            include Router::getSourcePath()."views/borrowing/borrowing.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_borrowingOT(){
        session_start();
        if ($_SESSION['member'] !== null){
            include Router::getSourcePath()."views/equipment/equipmentOperator.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_borrowingO(){
        session_start();
        if ($_SESSION['member'] !== null){
            $count_borrow = BorrowingO::Count_borrow();
            $count_equipment = BorrowingO::Count_equipment();
            $borrowList = BorrowingO::findAll();

            include Router::getSourcePath()."views/borrowing/borrowingOperator.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_equipmentST(){
        session_start();
        if ($_SESSION['member'] !== null){

            $count_type = Equipment::Count_type();
            $count_equipment = Equipment::Count_equipment();
            $count_item = Equipment::Count_item();
            $equipmentList = Equipment::findAll();
            include Router::getSourcePath()."views/equipment/equipment.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_equipmentO(){
        session_start();
        if ($_SESSION['member'] !== null){
            $typeList = Type::findAll();
            // print_r($typeList);
            $count_type = Equipment::Count_type();
            $count_equipment = Equipment::Count_equipment();
            $count_item = Equipment::Count_item();
            $equipmentList = Equipment::findAll();
            include Router::getSourcePath()."views/equipment/equipmentOperator.inc.php";
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function menu_type(){
        session_start();
        if ($_SESSION['member'] !== null){
            $count_type = Type::Count_type();
            $typeList = Type::findAll();
            include Router::getSourcePath()."views/type/type.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function login(string $username, string $password) {
        $member = Member::findByAccount($username,$password) ;
        if ($member !== null){
            session_start();
            // print_r($member);
            $_SESSION['member'] = $member;
            $count_type = Equipment::Count_type();
            $count_equipment = Equipment::Count_equipment();
            $count_item = Equipment::Count_item();
            $equipmentList = Equipment::findAll();
            $typeList = Type::findAll();
            if($member->getRole() == 'o')
                include Router::getSourcePath()."views/type/type.inc.php";
            if($member->getRole() == 't' || $member->getRole() == 's')
                include Router::getSourcePath()."views/equipment/equipment.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }

    private function logout(){
        echo "test";
        session_unset();
        session_destroy();
        if(ini_get("session.use_cookies")){
            setcookie(session_name(),'',time() - 3600,"/");
        }
        header("Location: ".Router::getSourcePath()."index.php?msg=ออกจากระบบสำเร็จ");
    }

    // ควรมีสำหรับ controller ทุกตัว
    private function index() {

    }

}