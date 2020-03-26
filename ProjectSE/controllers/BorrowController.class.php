<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:07
 */

class BorrowController {

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
            case "insertGet":
            case "insertReturn":
            case "addBorrow":
            case "insert":
            case "delete":
            case "update":
                $this->$action();
            case "index":
                $this->index();
                break;
            default:
                break;
        }

    }
    private function insertGet(){
        print_r($_POST);
        $id_b = $_POST['id_b_get'];
        $id_i = $_POST['id_i_get'];
        date_default_timezone_set('asia/bangkok');
        $dateTime_b = date('d-m-y h:i:s');
        // print_r($dateTime_b );
        $borrowing = new BorrowingO(); 
        $borrowing->setId_b($id_b);
        $borrowing->setId_i($id_i);
        $borrowing->setDateTime_b($dateTime_b);
        $borrowing->updateDateTimeB();

        // $borrowList = BorrowingO::findAll();

        header("Location: ".Router::getSourcePath()."index.php?controller=Member&action=menu_borrowingO");

        // include Router::getSourcePath()."views/borrowing/borrowingOperator.inc.php";

    }
    private function insertReturn(){
        // print_r($_POST);
        $id_b = $_POST['id_b_return'];
        $id_i = $_POST['id_i_r'];

        date_default_timezone_set('asia/bangkok');
        $dateTime_r = date('d-m-y h:i:s');
        // print_r($dateTime_r);
        $borrowing = new BorrowingO(); 
        $borrowing->setId_b($id_b);
        $borrowing->setId_i($id_i);
        $borrowing->setDateTime_r($dateTime_r);
        $borrowing->updateDateTimeR();

        // $borrowList = BorrowingO::findAll();

        header("Location: ".Router::getSourcePath()."index.php?controller=Member&action=menu_borrowingO");

        // include Router::getSourcePath()."views/borrowing/borrowingOperator.inc.php";

    }
    private function addBorrow(){
        session_start();
        if ($_SESSION['member'] !== null){
            if($_POST['action'] == "add"){
            $id_e = $_POST['id_e'];
            $name_e = $_POST['name_e'];
            $name_t = $_POST['name_t'];
            $note = $_POST['note'];
            $num = $_POST['num'];

            $add_b = array();

            $add_b['id_e'] = $id_e;
            $add_b['name_e'] = $name_e;
            $add_b['name_t'] = $name_t;
            $add_b['note'] = $note;
            $add_b['num'] = $num;

            $_SESSION['equipment_borrow'][]= $add_b;
            header('Content-Type: application/json');
            echo json_encode($_SESSION['equipment_borrow']);
            }else if($_POST['action'] == "del"){
                $id_e = $_POST['id_e'];
                $arr_ok = array();
                foreach($_SESSION['equipment_borrow'] as $eq){
                    // echo $eq['id_e'];
                    if($eq['id_e'] != $id_e){
                        // echo "yes ";
                        $arr_ok[]=$eq;
                    }
                }
                $_SESSION['equipment_borrow']= $arr_ok;
                header('Content-Type: application/json');
                echo json_encode($_SESSION['equipment_borrow']);
            }
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    
    private function delete(){
        session_start();
        if ($_SESSION['member'] !== null){
            print_r($_POST);
            echo $_POST['id_t'];
            $id_t = $_POST['id_t'];
            $type = new Type(); 
            $type->setId_t($id_t);
            $type->delete();
            $typeList = Type::findAll();

            include Router::getSourcePath()."views/type/type.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function insert(){
        session_start();
        if ($_SESSION['member'] !== null){
            // print_r($_POST);
            $name_t = $_POST['name_t_add'];
            $note = $_POST['note_add'];
            $type = new Type(); 
            $type->setName_t($name_t);
            $type->setNote($note);
            // echo $type->getName_t();
            $type->insert();
            $typeList = Type::findAll();

            include Router::getSourcePath()."views/type/type.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function update(){
        session_start();
        if ($_SESSION['member'] !== null){
            // print_r($_POST);
            $id_t = $_POST['id_t_edit'];
            $name_t = $_POST['name_t_edit'];
            $note = $_POST['note_edit'];
            $type = new Type(); 
            $type->setId_t($id_t);
            $type->setName_t($name_t);
            $type->setNote($note);
            // echo $type->getName_t();
            $type->update();
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
            $_SESSION['member'] = $member;
            $_SESSION['productList'] = Product::findAll();
            include Router::getSourcePath()."views/type/type.inc.php";
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