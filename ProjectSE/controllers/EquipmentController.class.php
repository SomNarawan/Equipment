<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:07
 */

class EquipmentController {

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
    private function delete(){
        session_start();
        if ($_SESSION['member'] !== null){
            print_r($_POST);
            echo $_POST['id_e'];
            $id_e = $_POST['id_e'];
            $equipment = new Equipment(); 
            $equipment->setId_t($id_e);
            $equipment->delete();
            $equipmentList = Equipment::findAll();

            include Router::getSourcePath()."views/equipment/EquipmentOperator.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function insert(){
        session_start();
        if ($_SESSION['member'] !== null){
            // print_r($_POST);
            $name_e = $_POST['name_e_add'];
            $note = $_POST['note_add'];
            $equipment = new Equipment(); 
            $equipment->setName_e($name_e);
            $equipment->setNote($note);
            // echo $type->getName_t();
            $equipment->insert();
            $equipmentList = Type::findAll();

            include Router::getSourcePath()."views/equipment/EquipmentOperator.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function update(){
        session_start();
        if ($_SESSION['member'] !== null){
            // print_r($_POST);
            $id_e = $_POST['id_t_edit'];
            $name_e = $_POST['name_t_edit'];
            $note = $_POST['note_edit'];
            $equipment = new Equipment(); 
            $equipment->setId_t($id_e);
            $equipment->setName_t($name_e);
            $equipment->setNote($note);
            // echo $type->getName_t();
            $equipment->update();
            $equipmentList = Equipment::findAll();

            include Router::getSourcePath()."views/equipment/EquipmentOperator.inc.php";

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
            include Router::getSourcePath()."views/equipment/EquipmentOperator.inc.php";
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