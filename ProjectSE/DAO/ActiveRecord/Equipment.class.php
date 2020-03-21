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
    private $name_t;
    private $note;
    private $count_equipment;
    private $count_lend_equipment;
    private $count_remain_equipment;
    private const TABLE = "equipment";

    //----------- Getters & Setters
    public function getId_e():int {
        return $this->id_e;
    }
    public function setId_e(int $id) {
        $this->id_e = $id;
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
        $query = "SELECT t4.id_e,t4.name_e,type.name_t,t4.note,count_all,lend,remain FROM(SELECT t3.id_t,t3.id_e,t3.name_e,type.name_t,t3.note,count_all,lend,remain FROM (SELECT t2.id_t,t2.id_e,t2.name_e,t2.note,count_all,if(count_no IS NULL,0,count_no)AS lend,(count_all-if(count_no IS NULL,0,count_no))AS remain FROM (SELECT equipment.id_t,equipment.id_e,COUNT(item.id_e) AS count_no FROM equipment LEFT JOIN item ON equipment.id_e = item.id_e WHERE item.status_i = 2 GROUP BY equipment.id_t,equipment.id_e) AS t1 RIGHT JOIN (SELECT equipment.id_t,equipment.id_e,name_e,equipment.note,COUNT(item.id_e) AS count_all FROM equipment LEFT JOIN item ON equipment.id_e = item.id_e WHERE item.status_i = 1 OR item.status_i = 2 GROUP BY equipment.id_t,equipment.id_e,name_e,equipment.note) AS t2 ON t1.id_e = t2.id_e)AS t3 LEFT JOIN type ON t3.id_e = type.id_t)AS t4 INNER JOIN type ON t4.id_t = type.id_t";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Equipment");
        $stmt->execute();
        $equipmentList  = array();
        while ($prod = $stmt->fetch())
        {
            $equipmentList[$prod->getId_e()] = $prod;
        }
        return $equipmentList;
    }
    public static function findById(int $id): ?Equipment {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE id_e = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Equipment");
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
        $query .= " WHERE id_e = ".$this->getId_e();
        $con = Db::getInstance();
        $res = $con->exec($query);
        return $res;
    }
    public function delete() {
        $con = Db::getInstance();
        $query = "DELETE FROM ".self::TABLE." WHERE id_e = ".$this->getId_e();
        $res = $con->exec($query);
        return $res;
    }

}