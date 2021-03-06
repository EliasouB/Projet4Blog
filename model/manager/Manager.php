<?php
namespace Blog\Model\Manager;

class Manager
{
	protected function dbConnect() // Connexion à la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}