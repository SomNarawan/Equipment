<?php
class Member{
    private $id_u;
    private $username;
    private $title;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $role;
    private $passwd;
    private const TABLE = "user";

    //----------- Getters & Setters
    public function getId_u()
    {
        return $this->id_u;
    }
    public function setId_u($id)
    {
        $this->id_u = $id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->emial = $email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
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

    //-----------
    public static function findByAccount($username,$passwd){
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE username ='$username' AND passwd='$passwd'";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Member");
        $stmt->execute();
        if ($prod = $stmt->fetch())
        {
            return $prod;
        }
        return null;
    }

    //----------- CRUD
    public static function findAll(): array {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE;
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Member");
        $stmt->execute();
        $productList  = array();
        while ($prod = $stmt->fetch())
        {
            $productList[$prod->getId()] = $prod;
        }
        return $productList;
    }
    public static function findById(int $id): ?Member {
        $con = Db::getInstance();
        $query = "SELECT * FROM ".self::TABLE." WHERE id = $id";
        $stmt = $con->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Member");
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
        $this->id = $con->lastInsertId();
        return $res;

    }
    public function update() {
        $query = "UPDATE ".self::TABLE." SET ";
        foreach ($this as $prop => $val) {
            $query .= " $prop='$val',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = ".$this->getId();
        $con = Db::getInstance();
        $res = $con->exec($query);
        return $res;
    }

}
?>