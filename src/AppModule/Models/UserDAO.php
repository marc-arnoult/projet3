<?php

namespace AppModule\Model;


use Core\Database\Database;

class UserDAO implements iDAO
{
    private $db;

    public function add(iModel $model)
    {

    }

    public function get($id) : User
    {

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