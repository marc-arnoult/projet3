<?php

namespace AppModule\Model;


use Core\Database\Database;


class UserDAO implements iDAO
{
    private $db;

    /**
     * UserDAO constructor.
     */
    function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @param iModel $model
     * @return bool
     */
    public function add(iModel $model)
    {
        $db = new Database();
        $req = $db->prepare('INSERT INTO user (pseudo, password, email, role, created_at) VALUES (:pseudo, :password, :email, :role, NOW())');
        $req->bindValue(':pseudo', $model->getPseudo(), \PDO::PARAM_STR);
        $req->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(':role', $model->getRole(), \PDO::PARAM_STR);
        return $req->execute();
    }

    /**
     * @param $values
     * @return mixed
     */
    public function get($values)
    {
        $data = $this->db->prepare("SELECT id, pseudo, email, role, created_at FROM user WHERE pseudo = :pseudo AND password = :password");
        $data->bindValue(':pseudo', $values['pseudo']);
        $data->bindValue(':password', $values['password']);
        $data->execute();
        $req = $data->fetch(\PDO::FETCH_ASSOC);
        return $req;
    }

    /**
     * @param null $cond
     * @return array
     */
    public function getAll($cond = null)
    {
        $req = null;
        if($cond) {
            $req = $this->db->prepare("SELECT id, pseudo, email, role, created_at FROM user LIMIT {$cond}");
        } else {
            $req = $this->db->prepare("SELECT id, pseudo, email, role, created_at FROM user");
        }

        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);

    }

    /**
     * @return mixed
     */
    public function getCountUser()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbUser FROM user", \PDO::FETCH_OBJ);

        return $number->fetch();
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user)
    {
        $req = $this->db->prepare("UPDATE user SET pseudo = :pseudo, password = :password, email = :email, role = :role WHERE id = {$user->getId()}");
        $req->bindValue(':title', $user->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $user->getContent(), \PDO::PARAM_STR);

        return $req->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $req = $this->db->prepare("DELETE FROM user WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        return $req->execute();
    }

    /**
     * @param Database $db
     * @return mixed|void
     */

    public function setDb(Database $db)
    {
        $this->db = $db;
    }
}