<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 10/02/2017
 * Time: 12:14
 */

namespace AppModule\Model;


use Core\Database\Database;

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
            $this->db->prepare('INSERT INTO comments (id_user, id_article, content, created_at, updated_at)
                                VALUES (:id_user, :id_article, :content, NOW(), NOW())');
            return $req->execute();
        } catch (\Exception $e) {
            echo 'Erreur ' . $e;
        }
    }

    public function get($id)
    {

    }

    public function getAll($idArticle)
    {
        $data = $this->db->query
                ("SELECT comments.*, user.pseudo, user.role
                FROM comments  
                LEFT JOIN user 
                ON comments.id_user = user.id 
                WHERE comments.id_article = $idArticle", \PDO::FETCH_OBJ);

        return $data->fetchAll();
    }

    public function getCountComment($idArticle)
    {
        $number = $this->db->query("SELECT COUNT(*) as nbComments 
                FROM comments  
                LEFT JOIN user 
                ON comments.id_user = user.id 
                WHERE comments.id_article = $idArticle", \PDO::FETCH_OBJ);

        return $number->fetch();
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