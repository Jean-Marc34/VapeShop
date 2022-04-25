<?php
abstract class Model
{

    private $pdo;

    private function setDB()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=vapeshop;charset=utf8", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    protected function getDB()
    {
        if ($this->pdo == null) {
            $this->setDB();
        }
        return $this->pdo;
    }
}
