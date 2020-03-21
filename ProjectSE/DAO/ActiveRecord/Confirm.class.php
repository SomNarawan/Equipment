<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Type {
    //------------- Properties
    private $id_c;
    private $username;
    private $fullname;
    private $name_e;
    private $name_t;
    private $num;
    private $dateTime_c;
    private $status;
    private const TABLE = "confirm";

    //----------- Getters & Setters
    public function getId_c():int {
        return $this->id_c;
    }
    public function setId_t(int $id) {
        $this->id_c = $id;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }
    public function getName_e()
    {
        return $this->name_e;
    }
    
    public function setName_t($name_e) {
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
    public function setNum(string $num) {
        $this->num = $num;
    }
    public function getDateTime_c(): int {
        return $this->count_equipment;
    }
    public function setDateTime_c(int $dateTime_c) {
        $this->dateTime_c = $dateTime_c;
    }
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    //----------- CRUD
    public static function findAll(): array {
        $con = Db::getInstance();
        $query = "SELECT type.id_t,type.name_t,type.note,COUNT(equipment.id_t) AS count_equipment FROM ".self::TABLE." LEFT JOIN equipment ON type.id_t = equipment.id_t
        GROUP BY type.id_t,type.name_t,type.note";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Type");
        $stmt->execute();
        $typeList  = array();
        while ($prod = $stmt->fetch())
        {
            $typeList[$prod->getId_t()] = $prod;
        }
        return $typeList;
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