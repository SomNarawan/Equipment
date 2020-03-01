<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 8/1/2562
 * Time: 15:21
 */

class Product
{
    private $product_id;
    private $product_name;
    private $price;

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

    /**
     * iterator สำหรับวนลูปเข้าถึง properties ทุกตัวของ Product ในลูป foreach ได้
     * @return ArrayIterator iterator ที่มี key เป็นชื่อ property และ value เป็นค่าของ property
     */
    public function getIterator()
    {
        return new ArrayIterator(get_object_vars($this));
    }
}