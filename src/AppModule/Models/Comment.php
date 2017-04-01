<?php

namespace AppModule\Model;


class Comment implements iModel
{

    private $id;
    private $id_user;
    private $id_article;
    private $id_parent;
    private $content;
    private $created_at;
    private $updated_at;
    private $depth;

    /**
     * Comment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * @param array $data
     * @return mixed|void
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $idUser
     */
    public function setId_user($idUser)
    {
        $this->id_user = $idUser;
    }

    /**
     * @return mixed
     */
    public function getId_article()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $idArticle
     */
    public function setId_article($idArticle)
    {
        $this->id_article = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getId_parent()
    {
        return $this->id_parent;
    }

    /**
     * @param mixed $id_parent
     */
    public function setId_parent($id_parent)
    {
        $this->id_parent = $id_parent;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }
}