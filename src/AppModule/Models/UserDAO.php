<?php

namespace AppModule\Model;


use Core\Database\Database;


class UserDAO implements iDAO
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    public function add($model)
    {
        $db = new Database();
        $req = $db->prepare('INSERT INTO user (pseudo, password, email, role, created_at) VALUES (:pseudo, :password, :email, :role, NOW())');
        $req->bindValue(':pseudo', $model->getPseudo(), \PDO::PARAM_STR);
        $req->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(':role', $model->getRole(), \PDO::PARAM_STR);
        return $req->execute();
    }

    public function get($options)
    {
        $data = $this->db->prepare("SELECT id, pseudo, email, role, created_at FROM user WHERE pseudo = :pseudo AND password = :password");
        $data->bindValue(':pseudo', $options['pseudo']);
        $data->bindValue(':password', $options['password']);
        $data->execute();
        $req = $data->fetch(\PDO::FETCH_ASSOC);
        return $req;
    }

    public function getAll($cond)
    {
        $db = new Database();

        if(!$cond) {
            $req = $db->prepare("SELECT * FROM user");
            $req->execute();

            return $req->fetchAll(\PDO::FETCH_OBJ);
        }

        $req = $db->prepare("SELECT * FROM user WHERE {$cond}");
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);

    }

    public function getCountUser()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbUser FROM user", \PDO::FETCH_OBJ);

        return $number->fetch();
    }

    public function update($user)
    {
        $req = $this->db->prepare("UPDATE user SET pseudo = :pseudo, password = :password, email = :email, role = :role WHERE id = {$user->getId()}");
        $req->bindValue(':title', $user->getTitle());
        $req->bindValue(':content', $user->getContent());

        return $req->execute();
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