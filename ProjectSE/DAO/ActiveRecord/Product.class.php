<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 23/1/2562
 * Time: 11:47
 */

class Product {
    //------------- Properties
    private $product_id;
    private $product_name;
    private $price;
    private const TABLE = "products";

    //----------- Getters & Setters
    public function getProductId():int {
        return $this->product_id;
    }
    public function setProductId(int $id) {
        $this->product_id = $id;
    }
    public function getProductName():string
    {
        return $this->product_name;
    }

    public function setProductName(string $name) {
        $this->product_name = $name;
    }
    public function getPrice(): float {
        return $this->price;
    }
    public function setPrice(float $price) {
        $this->price = $price;
    }

    //----------- CRUD
    public static function findAll(): array {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->execute();
        $productList  = array();
        while ($prod = $stmt->fetch())
        {
            $productList[$prod->getProductId()] = $prod;
        }
        return $productList;
    }
    public static function findById(int $id): ?Product {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE product_id = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
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
            $values .= "'$val',";
        }
        $values = substr($values,0,-1);
        $query = "INSERT INTO ".self::TABLE." VALUES ($values)";
        //echo $query;
        $res = $con->exec($query);
        $this->product_id = $con->lastInsertId();
        return $res;

    }
    public function update() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE product_id = ".$this->getProductId();
        $con = Db::getInstance();
        $res = $con->exec($query);
        return $res;
    }

}