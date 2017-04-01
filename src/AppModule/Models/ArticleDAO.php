<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 10/02/2017
 * Time: 12:14
 */

namespace AppModule\Model;


use Core\Database\Database;
use Core\Database\RedisCache;
use AppModule\Model\Article;

class ArticleDAO implements iDAO
{
    private $db;
    private $cache;

    /**
     * ArticleDAO constructor.
     * @param Database $db
     * @param RedisCache $cache
     */
    public function __construct(Database $db, RedisCache $cache)
    {
        $this->cache = $cache;
        $this->db = $db;
    }

    /**
     * @param iModel $article
     * @return bool
     */
    public function add(iModel $article)
    {
        $req = null;

        if($article->getPublished() == 0) {
            $req = $this->db->prepare('INSERT INTO articles (id_user, content, title, created_at, updated_at, published)
                            VALUES (:id_user, :content, :title, NULL, NOW(), :published)');
        } else {
            $req = $this->db->prepare('INSERT INTO articles (id_user, content, title, created_at, updated_at, published)
                            VALUES (:id_user, :content, :title, NOW(), NOW(), :published)');
        }
        $req->bindValue(':id_user', $article->getIdUser(), \PDO::PARAM_INT);
        $req->bindValue(':content', $article->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':title', $article->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':published', $article->getPublished(), \PDO::PARAM_INT);

        return $req->execute();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $data = $this->db->prepare("SELECT * FROM articles WHERE id = :id");
        $data->bindValue(':id', $id, \PDO::PARAM_INT);
        $data->execute();

        return $data->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function getPublished($id)
    {
        $updatedAt = $this->getUpdatedAt($id)->updated_at;

        return $this->cache->cache("article_{$id}_{$updatedAt}", function () use ($id) {

            $data = $this->db->prepare("SELECT * FROM articles WHERE id = :id AND published = true");
            $data->bindValue(':id', $id, \PDO::PARAM_INT);
            $data->execute();

            return $data->fetch(\PDO::FETCH_OBJ);
        });

    }

    /**
     * @param null $limit
     * @return mixed|string
     */
    public function getAllPublished($limit = null)
    {

        if($limit) {
            return $this->cache->cache(['last_article', $this->getLastUpdated()->updated_at] , function () use ($limit) {
                $data = $this->db->query("SELECT * FROM articles WHERE published = true ORDER BY created_at DESC LIMIT $limit", \PDO::FETCH_OBJ);
                return $data->fetchAll();
            });
        }
        return $this->cache->cache(['articles', $this->getLastUpdated()->updated_at], function () use ($limit) {

            $data = $this->db->query("SELECT articles.*, user.pseudo FROM articles LEFT JOIN user ON articles.id_user = user.id WHERE published = true ORDER BY id DESC", \PDO::FETCH_OBJ);
            return $data->fetchAll();
        });
    }

    /**
     * @param null $limit
     * @return array
     */
    public function getAll($limit = null)
    {
        if($limit) {
            $data = $this->db->query("SELECT * FROM articles ORDER BY id DESC LIMIT $limit", \PDO::FETCH_OBJ);
        } else {
            $data = $this->db->query("SELECT articles.*, user.pseudo FROM articles LEFT JOIN user ON articles.id_user = user.id ORDER BY id DESC", \PDO::FETCH_OBJ);
        }
        return $data->fetchAll();
    }


    /**
     * @return mixed
     */
    public function getCountArticles()
    {
        $number = $this->db->query("SELECT COUNT(*) as nbArticle FROM articles", \PDO::FETCH_OBJ);

        return $number->fetch();
    }

    /**
     * @return array
     */
    public function getAllByDate()
    {
        $data = $this->db->query("SELECT id, title, created_at FROM articles WHERE published = true ORDER BY created_at");

        $articles = $data->fetchAll();
        $articlesByDate = [];

        foreach ($articles as $article) {
            $article = new Article($article);
            $year = $article->getCreated_at()->format('Y');
            $month = $article->getCreated_at()->format('M');
            $articlesByDate[$year][$month][] = $article;
        }

        return $articlesByDate;
    }

    /**
     * @param $article
     * @return bool
     */

    public function update($article)
    {
        if($article->getPublished() == 0) {
            $req = $this->db->prepare("UPDATE articles SET title = :title, content = :content, updated_at = NOW(), published = :published WHERE id = {$article->getId()}");
        } else {
            $req = $this->db->prepare("UPDATE articles SET title = :title, content = :content, created_at = NOW(), updated_at = NOW(), published = :published WHERE id = {$article->getId()}");
        }
        $req->bindValue(':title', $article->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $article->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':published', $article->getPublished());

        return $req->execute();

    }

    /**
     * @return mixed
     */
    public function getLastUpdated()
    {
        $req = $this->db->prepare('SELECT updated_at FROM articles ORDER BY updated_at DESC LIMIT 1');
        $req->execute();

        return $req->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUpdatedAt($id)
    {
        $req = $this->db->prepare('SELECT updated_at FROM articles WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $cache = new RedisCache();

        $cache->del(['articles', $this->getLastUpdated()->updated_at]);
        $cache->del(['last_article', $this->getLastUpdated()->updated_at]);

        $req = $this->db->prepare("DELETE FROM articles WHERE id = :id");
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

    /**
     * @param RedisCache $cache
     */
    public function setCache(RedisCache $cache)
    {
        $this->cache = $cache;
    }
}