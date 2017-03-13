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

    public function add($article)
    {
        try {
            $req = $this->db->prepare('INSERT INTO articles (id_user, content, title,created_at, updated_at)
                                VALUES (:id_user, :content, :title, NOW(), NOW())');
            $req->bindValue(':id_user', $article->getIdUser(), \PDO::PARAM_INT);
            $req->bindValue(':content', $article->getContent(), \PDO::PARAM_STR);
            $req->bindValue(':title', $article->getTitle(), \PDO::PARAM_STR);
            return $req->execute();
        } catch (\Exception $e) {
            echo 'Erreur ' . $e;
        }
    }

    public function get($id)
    {
        $data = $this->db->query("SELECT * FROM articles WHERE id = {$id}", \PDO::FETCH_OBJ);
        return $data->fetch();
    }

    public function getAll($cond = null)
    {
        if($cond) {
            $data = $this->db->query("SELECT * FROM articles ORDER BY id DESC LIMIT $cond", \PDO::FETCH_OBJ);
        } else {
            $data = $this->db->query("SELECT * FROM articles ORDER BY id DESC", \PDO::FETCH_OBJ);
        }
        return $data->fetchAll();
    }

    public function getCountArticles()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbArticle FROM articles", \PDO::FETCH_OBJ);

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
        $this->db = $db;
    }
}