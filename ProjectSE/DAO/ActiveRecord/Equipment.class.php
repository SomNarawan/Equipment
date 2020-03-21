<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Equipment {
    //------------- Properties
    private $id_e;
    private $name_e;
    private $note;
    private $count_equipment;
    private $count_lend_equipment;
    private $count_remain_equipment;
    private const TABLE = "equipment";

    //----------- Getters & Setters
    public function getId_e():int {
        return $this->id_e;
    }
    public function setId_t(int $id) {
        $this->id_e = $id;
    }
    public function getName_e()
    {
        return $this->name_e;
    }
    public function setName_e($name_e) {
        $this->name_e = $name_e;
    }
    public function getNote(){
        return $this->note;
    }
    public function setNote(string $note) {
        $this->note = $note;
    }
    public function getCount_equipment(): int {
        return $this->count_equipment;
    }
    public function setCount_equipment(int $count) {
        $this->count_equipment = $count;
    }
    public function getCount_lend_equipment(): int {
        return $this->count_equipment;
    }
    public function setCount_lend_equipment(int $count) {
        $this->count_equipment = $count;
    }
    public function getCount_remain_equipment(): int {
        return $this->count_remain_equipment;
    }
    public function setCount_remain_equipment(int $count) {
        $this->count_remain_equipment = $count;
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