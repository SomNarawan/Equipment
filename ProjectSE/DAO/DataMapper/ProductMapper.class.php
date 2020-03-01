<?php


class ProductMapper
{
    private $productList;
    private const TABLE="products";

    public function __construct() {

        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->execute();
        $this->productList  = array();
        while ($prod = $stmt->fetch())
        {
            $this->productList[$prod->getProductId()] = $prod;
        }
    }

    public function getAll(): array {
        return $this->productList;
    }
    public function get(int $id): ?Product {
        return $this->productList[$id]??null;
    }
    public function update(Product $prod) {

        if (isset($this->productList[$prod->getProductId()])) {
            $query = "UPDATE ".self::TABLE." SET ";
            $prodIt = $prod->getIterator();
            foreach ($prodIt as $prop => $val) {
                $query .= " $prop='$val',";
            }
            $query = substr($query, 0, -1);
            $query .= " WHERE product_id = ".$prod->getProductId();
            //echo $query;
            $con = Db::getInstance();
            if ($con->exec($query) === true) {
                $this->productList[$prod->getProductId()] = $prod;
                return true;
            }
            return false;
        }
        else {
            throw new Exception("Product doesn't exist");
        }



    }

}