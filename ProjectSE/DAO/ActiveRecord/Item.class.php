<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Item {
    //------------- Properties
    private $id_i;
    private $note;
    private $id_e;
    private $status_i;
    private const TABLE = "item";

    //----------- Getters & Setters


    public function getId_i():string {
        return $this->id_i;
    }
    public function setId_i($id) {
        $this->id_i = $id;
    }
    public function getNote():string {
        return $this->note;
    }
    public function setNote($note) {
        $this->note = $note;
    }
    public function getId_e():int {
        return $this->id_i;
    }
    public function setId_e($id) {
        $this->id_e = $id;
    }
    public function getStatus_i():string {
        return $this->status_i;
    }
    public function setStatus_i($status_i) {
        $this->status_i = $status_i;
    }
    

   
    //----------- CRUD
    public static function findAll(): array {
        echo "dsssscscsscscs";
        $con = Db::getInstance();
        $id_e=$_GET['id_e'];
        $query = "SELECT item.id_i ,item.note ,item.id_e ,CASE item.status_i WHEN '1' THEN 'ยืมได้' WHEN '2' THEN 'ถูกยืม' ELSE 'ยืมไม่ได้' END AS status_i FROM item WHERE item.id_e=$id_e";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Item");
        $stmt->execute();
        $itemList  = array();
        while ($prod = $stmt->fetch())
        {
            $itemList[$prod->getId_i()] = $prod;
        }
        return $itemList;
    }
    public static function findById(int $id): ?Item {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE id_i = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Item");
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
            if($prop != "name_e" && $prop != "id_e")
                $values .= "'$val',";
        }
        print_r($values);
        $values = substr($values,0,-1);
        print_r($values);

        $query = "INSERT INTO ".self::TABLE." VALUES ($values)";
        //echo $query;
        $res = $con->exec($query);
        $this->product_id = $con->lastInsertId();
        return $res;

    }
    public function update() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            if($prop != "name_e" && $prop != "id_e")
                $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        //echo $query;
        $query .= " WHERE id_i = ".$this->getId_i();
        $con = Db::getInstance();
        $res = $con->exec($query);
        return $res;
    }
    public function delete() {
        $con = Db::getInstance();
        $query = "DELETE FROM ".self::TABLE." WHERE id_i = ".$this->getId_i();
        $res = $con->exec($query);
        return $res;
    }

}