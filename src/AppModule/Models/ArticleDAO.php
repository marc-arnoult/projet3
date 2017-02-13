<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 10/02/2017
 * Time: 12:14
 */

namespace AppModule\Model;


use Core\Database\Database;

class ArticleDAO implements iDAO
{

    public function add(iModel $model)
    {
        // TODO: Implement add() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public static function getAll()
    {
        $db = new Database();
        $data = $db->query('SELECT * FROM user', \PDO::FETCH_OBJ);
        var_dump($data->fetch());
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