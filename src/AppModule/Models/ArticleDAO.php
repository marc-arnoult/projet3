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
            $req = $this->db->prepare('INSERT INTO articles (id_user, content, title,created_at)
                                VALUES (:id_user, :content, :title, NOW())');
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
        $data = $this->db->prepare("SELECT * FROM articles WHERE id = :id");
        $data->bindValue(':id', $id, \PDO::PARAM_INT);
        $data->execute();

        return $data->fetch(\PDO::FETCH_OBJ);
    }

    public function getAll($cond = null)
    {
        if($cond) {
            $data = $this->db->query("SELECT * FROM articles ORDER BY id DESC LIMIT $cond", \PDO::FETCH_OBJ);
        } else {
            $data = $this->db->query("SELECT articles.*, user.pseudo FROM articles LEFT JOIN user ON articles.id_user = user.id ORDER BY id DESC", \PDO::FETCH_OBJ);
        }
        return $data->fetchAll();
    }

    public function getCountArticles()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbArticle FROM articles", \PDO::FETCH_OBJ);

        return $number->fetch();
    }

    public function update($article)
    {
        $req = $this->db->prepare("UPDATE articles SET title = :title, content = :content, updated_at = NOW() WHERE id = {$article->getId()}");
        $req->bindValue(':title', $article->getTitle());
        $req->bindValue(':content', $article->getContent());

        return $req->execute();

    }

    public function delete($id)
    {
        $req = $this->db->prepare("DELETE FROM articles WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        return $req->execute();
    }

    public function setDb(Database $db)
    {
        // TODO: Implement setDb() method.
    }
}