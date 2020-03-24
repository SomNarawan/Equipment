<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 24/1/2562
 * Time: 15:07
 */

class ItemController {

    /**
     * handleRequest จะทำการตรวจสอบ action และพารามิเตอร์ที่ส่งเข้ามาจาก Router
     * แล้วทำการเรียกใช้เมธอดที่เหมาะสมเพื่อประมวลผลแล้วส่งผลลัพธ์กลับ
     *
     * @param string $action ชื่อ action ที่ผู้ใช้ต้องการทำ
     * @param array $params พารามิเตอร์ที่ใช้เพื่อในการทำ action หนึ่งๆ
     */
    public function handleRequest(string $action="index", array $params) {
        //echo $action;
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
            // print_r($_POST);
            //echo $_POST['id_i'];
            $id_i = $_POST['id_i'];
            $id_e = $_POST['id_e'];
            $name_e = $_POST['name_e'];

            $item = new Item(); 
            $item->setId_i($id_i);
            $item->delete();
            $itemList = Item::findAll($id_e);
            //include Router::getSourcePath()."views/item/item.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function insert(){
        //echo "testtt";
        session_start();
        if ($_SESSION['member'] !== null){
            print_r($_POST);
            $id_i = $_POST['id_i_add'];
            $note=$_POST['note_add'];
            $id_e=$_POST['id_e_add'];
            $status_i = $_POST['status_i_add'];
            $item = new Item(); 
            $item->setId_i($id_i);
            $item->setNote($note);
            $item->setId_e($id_e);
            $item->set($status_i);
            // echo $type->getName_t();
            $item->insert();
            $itemList = Item::findAll($id_e);
            //$equipmentList = Equipment::findAll();
            

            include Router::getSourcePath()."views/item/item.inc.php";

        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function update(){
        //echo "this";
        session_start();
        if ($_SESSION['member'] !== null){
            //print_r($_POST);
            $id_i = $_POST['id_i_add'];
            $note=$_POST['note_add'];
            $id_e=$_POST['id_e'];
            $status_i = $_POST['status_i_add'];
            $item = new Item(); 
            $item->setId_i($id_i);
            $item->setNote($note);
            $item->setId_e($id_e);
            $item->set($status_i);
            // echo $equipment->getName_e();
            $item->update();
            $itemList = Item::findAll($id_e);
            //$typeList = Type::findAll();

            include Router::getSourcePath()."views/item/item.inc.php";

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