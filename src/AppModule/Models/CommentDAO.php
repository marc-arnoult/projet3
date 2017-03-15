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

    public function add($comment)
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

    public function getAll($idArticle)
    {
        $req = $this->db->prepare
                ("SELECT comments.*, user.pseudo, user.role
                FROM comments  
                LEFT JOIN user 
                ON comments.id_user = user.id 
                WHERE comments.id_article = :id_article");
        $req->bindValue(':id_article', $idArticle, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllWithChildren($idArticle)
    {
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
    }
    public function getCountComment($idArticle)
    {
        $number = $this->db->prepare("SELECT COUNT(*) as nbComments 
                FROM comments  
                LEFT JOIN user 
                ON comments.id_user = user.id 
                WHERE comments.id_article = :id_article");
        $number->bindValue(':id_article', $idArticle, \PDO::PARAM_INT);
        $number->execute();

        return $number->fetch(\PDO::FETCH_OBJ);
    }

    public function update($comment)
    {
        $req = $this->db->prepare("UPDATE comments SET content = :content, updated_at = NOW() WHERE id = {$comment->getId()}");
        $req->bindValue(':content', $comment->getContent());

        return $req->execute();
    }

    public function delete($id)
    {
        $req = $this->db->prepare("DELETE FROM comments WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        return $req->execute();
    }

    public function setDb(Database $db)
    {
        $this->db = $db;
    }
}