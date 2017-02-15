<?php

namespace AppModule\Model;


use Core\Database\Database;

class UserDAO implements iDAO
{
    public function add(iModel $model)
    {
        $db = new Database();
        $req = $db->prepare('INSERT INTO user (pseudo, password, email, role, created_at) VALUES (:pseudo, :password, :email, :role, NOW())');
        $req->bindValue(':pseudo', $model->getPseudo());
        $req->bindValue(':password', $model->getPassword());
        $req->bindValue(':email', $model->getEmail());
        $req->bindValue(':role', $model->getRole());
        $req->execute();
    }

    public function get($id)
    {

    }

    public function getAll()
    {
        $db = new Database();
        $data = $db->query("SELECT * FROM user", \PDO::FETCH_OBJ);
        return $data->fetch();
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function setDb(Database $db)
    {
        // TODO: Implement setDb() method.
    }
}