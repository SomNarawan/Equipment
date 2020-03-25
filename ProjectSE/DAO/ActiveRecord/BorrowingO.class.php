<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class BorrowingO {
    //------------- Properties
    private $id_b;
    private $username;
    private $title;
    private $name;
    private $surname;
    private $name_e;
    private $id_i;
    private $id_e;
    private $dateTime_b;
    private $dateTime_r;
    private const TABLE = "borrowing";

    //----------- Getters & Setters
    public function getId_b() {
        return $this->id_b;
    }
    public function setId_b($id) {
        $this->id_b = $id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getTitile()
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
    public function getId_i()
    {
        return $this->id_i;
    }

    public function setId_i($id) {
        $this->id_i = $id;
    }   
    public function getId_e()
    {
        return $this->id_e;
    }

    public function setId_e($id_e) {
        $this->id_e = $id;
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
    
    public static function Count_equipment(){
        $con = Db::getInstance();
        $query = "SELECT COUNT(*) AS count_equipment FROM borrowing";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_equipment= $row['count_equipment'];
        }
        
        return $count_equipment;
    }
    public static function Count_borrow(){
        $con = Db::getInstance();
        $query = "SELECT COUNT(DISTINCT(confirm.id_u)) AS count_borrow FROM borrowing 
        JOIN detailconfirm ON borrowing.id_dc = detailconfirm.id_dc
        JOIN confirm ON confirm.id_c = detailconfirm.id_c";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->query($query);
        while ($row = $stmt->fetch()) {
            $count_borrow= $row['count_borrow'];
        }
        
        return $count_borrow;
    }
    //----------- CRUD
    public static function findAll(): array {
        $con = Db::getInstance();
        $query = "SELECT borrowing.id_b,user.username,user.title,user.name,user.surname,equipment.name_e,borrowing.id_i,equipment.id_e,borrowing.dateTime_b,borrowing.dateTime_r FROM detailconfirm 
        JOIN confirm ON detailconfirm.id_c = confirm.id_c
        JOIN borrowing ON borrowing.id_dc = detailconfirm.id_dc
        LEFT JOIN item ON item.id_i = borrowing.id_i
        LEFT JOIN equipment ON equipment.id_e = detailconfirm.id_e
        LEFT JOIN user ON user.id_u = confirm.id_u";
        // $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "BorrowingO");
        $stmt->execute();
        $borrowingList  = array();
        while ($prod = $stmt->fetch())
        {
            $borrowingList[$prod->getId_b()] = $prod;
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
    public function updateDateTimeB() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            if($prop == "dateTime_b" || $prop == "id_i")
                $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        echo $query;
        $query .= " WHERE id_b = ".$this->getId_b();
        $con = Db::getInstance();
        $res = $con->exec($query);

        $query = "UPDATE item SET item.status_i = 2 WHERE id_i = '".$this->getId_i()."'";
        echo $query;
        $con = Db::getInstance();
        $res = $con->exec($query);

        return $res;
    }
    public function updateDateTimeR() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            if($prop == "dateTime_r")
                $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id_b = ".$this->getId_b();
        $con = Db::getInstance();
        $res = $con->exec($query);

        $query = "UPDATE item SET item.status_i = 1 WHERE id_i = '".$this->getId_i()."'";
        echo $query;
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