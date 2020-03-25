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
    private $id_t;
    private $note;
    private $count_equipment;
    private $count_lend_equipment;
    private $count_no_equipment;
    private $count_remain_equipment;
    private const TABLE = "equipment";

    //----------- Getters & Setters
    public function getId_e():int {
        return $this->id_e;
    }
    public function setId_e(int $id) {
        $this->id_e = $id;
    }
    public function getId_t():int {
        return $this->id_t;
    }
    public function setId_t(int $id) {
        $this->id_t = $id;
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
        return $this->count_lend_equipment;
    }
    public function setCount_lend_equipment(int $count) {
        $this->count_lend_equipment = $count;
    }
    public function getCount_no_equipment(): int {
        return $this->count_no_equipment;
    }
    public function setCount_no_equipment(int $count) {
        $this->count_no_equipment = $count;
    }
    public function getCount_remain_equipment(): int {
        return $this->count_remain_equipment;
    }
    public function setCount_remain_equipment(int $count) {
        $this->count_remain_equipment = $count;
    }
    public static function Count_type(){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_type FROM type";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_type= $row['count_type'];
        }
        
        return $count_type;
    }
    public static function Count_equipment(){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_equipment FROM equipment";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_equipment= $row['count_equipment'];
        }
        
        return $count_equipment;
    }
    public static function Count_item(){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_item FROM item";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_item= $row['count_item'];
        }
        
        return $count_item;
    }
    //----------- CRUD
    public static function findAll(): array {
        $con = Db::getInstance();
        $query = "SELECT t5.id_t,t5.id_e,t5.name_e,t5.name_t,t5.note,t5.count_equipment,t5.count_lend_equipment,if(t6.count_no IS null,0,t6.count_no) AS count_no_equipment,(t5.count_remain_equipment-if(t6.count_no IS NULL,0,t6.count_no))AS count_remain_equipment FROM
        (SELECT type.id_t,t4.id_e,t4.name_e,type.name_t,t4.note,count_all as count_equipment,lend as count_lend_equipment,remain as count_remain_equipment FROM(SELECT t3.id_t,t3.id_e,t3.name_e,type.name_t,t3.note,count_all,lend,remain FROM (SELECT t2.id_t,t2.id_e,t2.name_e,t2.note,count_all,if(count_no IS NULL,0,count_no)AS lend,(count_all-if(count_no IS NULL,0,count_no))AS remain FROM 
                (SELECT equipment.id_t,equipment.id_e,COUNT(item.id_e) AS count_no FROM equipment 
                LEFT JOIN item ON equipment.id_e = item.id_e 
                 WHERE item.status_i = 2 
                 GROUP BY equipment.id_t,equipment.id_e) AS t1 
                RIGHT JOIN 
                (SELECT equipment.id_t,equipment.id_e,name_e,equipment.note,COUNT(item.id_e) AS count_all FROM equipment 
                 LEFT JOIN item ON equipment.id_e = item.id_e 
                GROUP BY equipment.id_t,equipment.id_e,name_e,equipment.note) AS t2
                ON t1.id_e = t2.id_e)AS t3
                LEFT JOIN type
                ON t3.id_e = type.id_t)AS t4
                INNER JOIN type
                ON t4.id_t = type.id_t)AS t5
                LEFT JOIN
                (SELECT t5.id_t,t5.id_e,t5.count_no,t1.count_b FROM
                    (SELECT equipment.id_t,equipment.id_e,COUNT(item.id_e) AS count_no FROM equipment 
                LEFT JOIN item ON equipment.id_e = item.id_e 
                 WHERE item.status_i = 3
                 GROUP BY equipment.id_t,equipment.id_e) AS t5
                    
                 LEFT JOIN
                    
                (SELECT equipment.id_t,equipment.id_e,COUNT(item.id_e) AS count_b FROM equipment 
                LEFT JOIN item ON equipment.id_e = item.id_e 
                 WHERE item.status_i = 2 
                 GROUP BY equipment.id_t,equipment.id_e) AS t1 
                 
                  ON t5.id_e = t1.id_e)AS t6
                  ON t5.id_e = t6.id_e";
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
        echo "insert";
        $con = Db::getInstance();
        $values = "";
        foreach ($this as $prop => $val) {
            if($prop != "name_t" && $prop != "count_equipment" && $prop != "count_lend_equipment" && $prop != "count_remain_equipment"  )
                $values .= "'$val',";
        }
        //print_r($values);
        $values = substr($values,0,-1);
        //print_r($values);

        $query = "INSERT INTO ".self::TABLE." VALUES ($values)";
        //echo $query;
        $res = $con->exec($query);
        $this->product_id = $con->lastInsertId();
        return $res;

    }
    public function update() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            if($prop != "name_t" && $prop != "count_equipment" && $prop != "count_lend_equipment" && $prop != "count_remain_equipment")
                $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        //echo $query;
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