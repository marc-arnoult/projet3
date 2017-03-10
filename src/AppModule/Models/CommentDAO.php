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
        try {
            $req = $this->db->prepare('INSERT INTO comments (id_user, id_article, content, id_parent, created_at, updated_at)
                                VALUES (:id_user, :id_article, :content, :id_parent, NOW(), NOW())');
            $req->bindValue(':id_user', $comment->getId_user());
            $req->bindValue(':id_article', $comment->getId_article());
            $req->bindValue(':content', $comment->getContent());
            if ($comment->getId_parent()) {
                $req->bindValue(':id_parent', $comment->getId_parent());
            } else {
                $req->bindValue(':id_parent', null);
            }

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
                WHERE comments.id_article = $idArticle
                ORDER BY comments.created_at", \PDO::FETCH_OBJ);

        return $data->fetchAll();
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