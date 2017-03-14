<?php

namespace AppModule\Model;


use Core\Database\Database;
use AppModule\Model\User;

class UserDAO
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    public function add($model)
    {
        try {
            $db = new Database();
            $req = $db->prepare('INSERT INTO user (pseudo, password, email, role, created_at) VALUES (:pseudo, :password, :email, :role, NOW())');
            $req->bindValue(':pseudo', $model->getPseudo(), \PDO::PARAM_STR);
            $req->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
            $req->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
            $req->bindValue(':role', $model->getRole(), \PDO::PARAM_STR);
            return $req->execute();
        } catch (\Exception $e) {
            echo 'Erreur ' . $e;
        }
    }

    public function get($pseudo, $password)
    {
        $data = $this->db->prepare("SELECT id, pseudo, email, role, created_at FROM user WHERE pseudo = :pseudo AND password = :password");
        $data->bindValue(':pseudo', $pseudo);
        $data->bindValue(':password', $password);
        $data->execute();
        $req = $data->fetch(\PDO::FETCH_ASSOC);
        return $req;
    }

    public function getAll()
    {
        $db = new Database();
        $data = $db->query("SELECT * FROM user", \PDO::FETCH_OBJ);
        return $data->fetch();
    }

    public function getCountUser()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbUser FROM user", \PDO::FETCH_OBJ);

        return $number->fetch();
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function setDb(Database $db)
    {
        $this->db = $db;
    }
}