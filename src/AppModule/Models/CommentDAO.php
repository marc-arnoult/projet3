<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 10/02/2017
 * Time: 12:14
 */

namespace AppModule\Model;


class CommentDAO implements iDAO
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function add(iModel $model)
    {
        try {
            $req = $this->db->prepare('INSERT INTO user (pseudo, password, email, role, created_at) VALUES (:pseudo, :password, :email, :role, NOW())');
            $req->bindValue(':pseudo', $model->getPseudo(), \PDO::PARAM_STR);
            $req->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
            $req->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
            $req->bindValue(':role', $model->getRole(), \PDO::PARAM_STR);
            return $req->execute();
        } catch (\Exception $e) {
            echo 'Erreur ' . $e;
        }
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
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