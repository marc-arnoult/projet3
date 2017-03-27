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

class CommentDAO implements iDAO
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function add(iModel $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments (id_user, id_article, content, id_parent, depth, created_at, updated_at)
                            VALUES (:id_user, :id_article, :content, :id_parent, :depth, NOW(), NOW())');
        $req->bindValue(':id_user', $comment->getId_user(), \PDO::PARAM_INT);
        $req->bindValue(':id_article', $comment->getId_article(), \PDO::PARAM_INT);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);

        if ($comment->getId_parent() != null) {
            $parentId = $comment->getId_parent();
            $depth = $this->get($parentId)->depth + 1;
            $req->bindValue(':id_parent', $comment->getId_parent(), \PDO::PARAM_INT);
            $req->bindValue(':depth', $depth, \PDO::PARAM_STR);
        } else {
            $req->bindValue(':id_parent', null);
            $req->bindValue(':depth', null);
        }
        return $req->execute();
    }

    public function get($id)
    {
        $req = $this->db->prepare("SELECT * FROM comments WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(\PDO::FETCH_OBJ);
    }

    public function getAll($idArticle = null)
    {
        if($idArticle != null) {
            $req = $this->db->prepare
                    ("SELECT comments.*, user.pseudo, user.role
                    FROM comments  
                    LEFT JOIN user 
                    ON comments.id_user = user.id 
                    WHERE comments.id_article = :id_article");
            $req->bindValue(':id_article', $idArticle, \PDO::PARAM_INT);
            $req->execute();
        } else {
            $req = $this->db->prepare
                    ("SELECT comments.*, user.pseudo
                    FROM comments
                    LEFT JOIN user 
                    ON comments.id_user = user.id");
            $req->execute();
        }

        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getLast($limit)
    {
        $req = $this->db->prepare
        ("SELECT comments.*, user.pseudo, user.role
            FROM comments  
            LEFT JOIN user 
            ON comments.id_user = user.id 
            LIMIT {$limit}");
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllWithChildren($idArticle)
    {
        $cache = new RedisCache();

        return $cache->cache(['comments', $this->getLastUpdated($idArticle)], function () use ($idArticle) {
            $comments = $this->getAll($idArticle);
            $comments_by_id = [];

            foreach ($comments as $comment) {
                $comments_by_id[$comment->id] = $comment;
            }

            foreach ($comments as $k => $comment) {
                if($comment->id_parent !== null) {
                    $comments_by_id[$comment->id_parent]->children[] = $comment;
                    unset($comments[$k]);
                }
            }
            return $comments;
        });
    }
    public function getCountComment($idArticle = null)
    {   $number = null;

        if($idArticle) {
            $number = $this->db->prepare("SELECT COUNT(*) as nbComments FROM comments WHERE id_article = {$idArticle}");
        } else {
            $number = $this->db->prepare("SELECT COUNT(*) as nbComments FROM comments");
        }

        $number->execute();

        return $number->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param iModel $comment
     * @return bool
     */
    public function update(iModel $comment)
    {
        $req = $this->db->prepare("UPDATE comments SET content = :content, updated_at = NOW() WHERE id = {$comment->getId()}");
        $req->bindValue(':content', $comment->getContent());

        return $req->execute();
    }

    public function getLastUpdated($idArticle)
    {
        $req = $this->db->prepare('SELECT updated_at FROM comments WHERE id_article = :id_article ORDER BY updated_at DESC LIMIT 1');
        $req->bindValue(':id_article', $idArticle, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(\PDO::FETCH_OBJ);
    }

    public function getUpdatedAt($id)
    {
        $req = $this->db->prepare('SELECT updated_at FROM comments WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(\PDO::FETCH_OBJ);
    }

    public function delete($id)
    {
        $req = $this->db->prepare("DELETE FROM comments WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        return $req->execute();
    }

    public function addReport($id)
    {
        $req = $this->db->prepare("SELECT * FROM reporting_comment WHERE id_comment = {$id}");
        $req->execute();

        $result = $req->fetch();

        if($result) {
            $update = $this->db->prepare("UPDATE reporting_comment SET nbr_report = nbr_report + 1 WHERE id_comment = {$id}");

            return $update->execute();
        } else if (!$result) {
            $adding = $this->db->prepare("INSERT INTO reporting_comment (id_comment, nbr_report) VALUES (:id_comment, :nbr_report)");
            $adding->bindValue(':id_comment', $id, \PDO::PARAM_INT);
            $adding->bindValue(':nbr_report', 1, \PDO::PARAM_INT);

            return $adding->execute();
        } else {
            return 'FATAL ERROR';
        }
    }

    public function getAllWithReport()
    {
        $req = $this->db->prepare('SELECT comments.*, user.pseudo, user.role, reporting_comment.nbr_report
                                    FROM comments  
                                    LEFT OUTER JOIN user 
                                    ON comments.id_user = user.id
                                    LEFT OUTER JOIN reporting_comment
                                    ON comments.id = reporting_comment.id_comment
                                    ORDER BY created_at DESC;');
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function setDb(Database $db)
    {
        $this->db = $db;
    }
}