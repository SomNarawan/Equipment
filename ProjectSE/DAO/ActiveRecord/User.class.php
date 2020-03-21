<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Type {
    //------------- Properties
    private $id_u;
    private $username;
    private $title;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $role;
    private const TABLE = "user";

    //----------- Getters & Setters
    public function getId_u():int {
        return $this->id_u;
    }
    public function setId_u(int $id) {
        $this->id_u = $id;
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
    public function getTitle()
    {
        return $this->title;
    }

    public function setName($name) {
        $this->name = $name;
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
    ublic function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function setPhone(string $phone) {
        $this->phone = $phone;
    }
    public function getRole(): int {
        return $this->role;
    }
    public function setRole(int $role) {
        $this->role = $role;
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