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
            case "borrow":
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
    private function addBorrow(){
        session_start();
        if ($_SESSION['member'] !== null){

            $json = '{"name":"John", "age":25, "Tel":["0956542121","0996563366"],
                "address": {"street":"Sathorn", "province":"Bangkok"}}';
            $obj = json_decode($json);
            header('Content-Type: application/json');
            echo json_encode($obj);
            // print_r($obj);
        }
        else {
            header("Location: ".Router::getSourcePath()."index.php?msg=invalid user");
        }
    }
    private function borrow(){
        session_start();
        if ($_SESSION['member'] !== null){
            print_r($_POST);
            if(isset($_POST["add_borrow"])){
                if(isset($_SESSION["equip_borrow"]))
                {
                     $item_array_id = array_column($_SESSION["equip_borrow"], "item_id");
                     if(!in_array($_GET["id"], $item_array_id))
                     {
                          $count = count($_SESSION["equip_borrow"]);
                          $item_array = array(
                               'id_e'               =>     $_POST["id_e"],
                               'name_e'               =>     $_POST["name_e"],
                               'name_t'          =>     $_POST["name_t"],
                               'quantity'          =>     $_POST["quantity"]
                          );
                          $_SESSION["equip_borrow"][$count] = $item_array;
                     }
                     else
                     {
                          echo '<script>alert("สินค้าถูกเพิ่มแล้ว")</script>';
                        //   echo '<script>window.location="index.php"</script>';
                     }
                }
                else
                {
                     $item_array = array(
                          'item_id'               =>     $_GET["id"],
                          'item_name'               =>     $_POST["hidden_name"],
                          'item_price'          =>     $_POST["hidden_price"],
                          'item_quantity'          =>     $_POST["quantity"]
                     );
                     $_SESSION["equip_borrow"][0] = $item_array;
                }
           }

            $equipmentList  = Equipment::findAll();

            include Router::getSourcePath()."views/borrow/borrow.inc.php";

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