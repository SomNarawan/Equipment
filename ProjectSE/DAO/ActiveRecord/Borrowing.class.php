<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Borrowing {
    //------------- Properties
    private $id_dc;
    private $name_e;
    private $name_t;
    private $num;
    private $status;
    private $dateTime_b;
    private $dateTime_r;
    private $reason;
    private const TABLE = "borrowing";

    //----------- Getters & Setters
    public function getId_dc() {
        return $this->id_dc;
    }
    public function setId_dc($id) {
        $this->id_dc = $id;
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
    public function getNum()
    {
        return $this->num;
    }

    public function setNum($num) {
        $this->num = $num;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
   
    public function getDateTime_b(){
        return $this->dateTime_b;
    }
    public function setDateTime_b($dateTime_b) {
        $this->dateTime_b = $dateTime_b;
    }
    public function getDateTime_r(){
        return $this->dateTime_r;
    }
    public function setDateTime_r($dateTime_r) {
        $this->dateTime_r = $dateTime_r;
    }
    public function getReason() {
        return $this->reason;
    }
    public function setReason($reason) {
        $this->reason = $reason;
    }
    public static function Count_equipment($id_u){
        $con = Db::getInstance();
        $query = "SELECT if(SUM(detailconfirm.num) != null,SUM(detailconfirm.num),0) AS count_equipment FROM detailconfirm
        JOIN confirm ON confirm.id_c = detailconfirm.id_c
        WHERE confirm.id_u = $id_u";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_equipment= $row['count_equipment'];
        }
        
        return $count_equipment;
    }
    //----------- CRUD
    public static function findAll($id_u): array {
        $con = Db::getInstance();
        $query = "SELECT detailconfirm.id_dc,equipment.name_e,type.name_t,detailconfirm.num,detailconfirm.status,borrowing.dateTime_b,borrowing.dateTime_r,detailconfirm.deny FROM detailconfirm
        LEFT JOIN borrowing  ON borrowing.id_dc = detailconfirm.id_dc
        LEFT JOIN confirm ON confirm.id_c = detailconfirm.id_c
        LEFT JOIN equipment ON equipment.id_e = detailconfirm.id_e
        LEFT JOIN type ON type.id_t = equipment.id_t
        WHERE confirm.id_u = $id_u";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Borrowing");
        $stmt->execute();
        $borrowingList  = array();
        while ($prod = $stmt->fetch())
        {
            $borrowingList[$prod->getId_dc()] = $prod;
        }
        return $borrowingList;
    }
    public static function findById(int $id): ?Type {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE id_t = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Type");
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