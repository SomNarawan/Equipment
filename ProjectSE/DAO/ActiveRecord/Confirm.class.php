<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Confirm {
    //------------- Properties
    private $id_dc;
    private $username;
    private $title;
    private $name;
    private $surname;
    private $name_e;
    private $name_t;
    private $num;
    private $dateTime_c;
    private $status;
    private $reason;

    private const TABLE = "confirm";

    //----------- Getters & Setters
    public function getId_dc(){
        return $this->id_dc;
    }
    public function setId_dc($id) {
        $this->id_dc = $id;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }
    public function getName_e()
    {
        return $this->name_e;
    }
    
    public function setName_e($name_e) {
        $this->name_e = $name_e;
    }
    public function getName_t()
    {
        return $this->name_t;
    }

    public function setName_t($name_t) {
        $this->name_t = $name_t;
    }
    public function getNum(){
        return $this->num;
    }
    public function setNum($num) {
        $this->num = $num;
    }
    public function getDateTime_c() {
        return $this->dateTime_c;
    }
    public function setDateTime_c($dateTime_c) {
        $this->dateTime_c = $dateTime_c;
    }
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getReason()
    {
        return $this->reason;
    }
    
    public function setReason($reason) {
        $this->reason = $reason;
    }

    //----------- CRUD
    public static function findAll($id_resp): array {
        $con = Db::getInstance();
        $query = "SELECT  detailconfirm.id_dc,users.username,users.title,users.name,users.surname,equipment.name_e,type.name_t,detailconfirm.num,confirm.dateTime_c,detailconfirm.status,confirm.reason FROM confirm 
        JOIN users ON confirm.id_u = users.id_u
        JOIN detailconfirm ON confirm.id_c = detailconfirm.id_c
        JOIN equipment ON detailconfirm.id_e = equipment.id_e
        JOIN type ON equipment.id_t = type.id_t
        WHERE confirm.id_resp = $id_resp";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Confirm");
        $stmt->execute();
        $confirmList  = array();
        while ($prod = $stmt->fetch())
        {
            $confirmList[$prod->getId_dc()] = $prod;
        }
        return $confirmList;
    }
    public static function Count_confirm($id_resp){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_confirm FROM confirm 
        JOIN detailconfirm ON confirm.id_c = detailconfirm.id_c
        WHERE id_resp = $id_resp";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_confirm= $row['count_confirm'];
        }
        
        return $count_confirm;
    }
    public static function Count_student($id_resp){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_student FROM confirm 
        JOIN users ON confirm.id_u = users.id_u
        WHERE confirm.id_resp = $id_resp";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_student = $row['count_student'];
        }
        
        return $count_student;
    }
    public static function findById(int $id): array {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE id_t = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Confirm");
        $stmt->execute();
        if ($prod = $stmt->fetch())
        {
            return $prod;
        }
        return null;
    }
    public function insert() {
        $con = Db::getInstance();
        $values = "";
        foreach ($this as $prop => $val) {
            if($prop != "count_equipment")
                $values .= "'$val',";
        }
        // print_r($values);
        $values = substr($values,0,-1);
        // print_r($values);

        $query = "INSERT INTO ".self::TABLE." VALUES ($values)";
        //echo $query;
        $res = $con->exec($query);
        $this->product_id = $con->lastInsertId();
        return $res;

    }
    public function update() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            if($prop != "count_equipment")
                $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id_t = ".$this->getId_t();
        $con = Db::getInstance();
        $res = $con->exec($query);
        return $res;
    }
    public function delete() {
        $con = Db::getInstance();
        $query = "DELETE FROM ".self::TABLE." WHERE id_t = ".$this->getId_t();
        $res = $con->exec($query);
        return $res;
    }

}