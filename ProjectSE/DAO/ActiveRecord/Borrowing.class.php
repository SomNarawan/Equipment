<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Type {
    //------------- Properties
    private $id_b;
    private $username;
    private $fullname;
    private $name_e;
    private $id_i;
    private $num;
    private $dateTime_b;
    private $dateTime_r;
    private $id_dc;
    private const TABLE = "borrowing";

    //----------- Getters & Setters
    public function getId_b():int {
        return $this->id_b;
    }
    public function setId_b(int $id) {
        $this->id_b = $id;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
    ublic function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }
    ublic function getName_e()
    {
        return $this->name_e;
    }

    public function setName_e($name_e) {
        $this->name_e = $name_e;
    }
    public function getId_i():int {
        return $this->id_i;
    }
    public function setId_i(int $id) {
        $this->id_i = $id;
    }

    public function getNum(){
        return $this->num;
    }
    public function setNum(string $num) {
        $this->num = $num;
    }
    public function getDateTime_b(): int {
        return $this->dateTime_b;
    }
    public function setDateTime_b(int $dateTime_b) {
        $this->dateTime_b = $dateTime_b;
    }
    public function getDateTime_r(): int {
        return $this->dateTime_r;
    }
    public function setDateTime_r(int $dateTime_r) {
        $this->dateTime_r = $dateTime_r;
    }
    public function getId_dc():int {
        return $this->id_dc;
    }
    public function setId_dc(int $id) {
        $this->id_dc = $id;
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