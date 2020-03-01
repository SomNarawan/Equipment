<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 8/1/2562
 * Time: 15:21
 */

class Member
{
    private $id;
    private $username;
    private $passwd;
    private $name;
    private $surname;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
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