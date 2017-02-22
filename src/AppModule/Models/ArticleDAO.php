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
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function add(iModel $article)
    {

    }

    public function get($id)
    {
        $db = $this->db;
        $data = $db->query("SELECT * FROM articles WHERE id = {$id}", \PDO::FETCH_OBJ);
        return $data->fetch();
    }

    public function getAll($cond = null)
    {
        $db = $this->db;
        $data = $db->query('SELECT * FROM articles', \PDO::FETCH_OBJ);
        return $data->fetchAll();
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