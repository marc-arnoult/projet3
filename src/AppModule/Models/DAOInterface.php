<?php

namespace AppModule\Model;


use Core\Database\CacheInterface;
use Core\Database\Database;

interface DAOInterface
{
    public function __construct(Database $db, CacheInterface $cache);

    /**
     * @param modelInterface $model
     * @return mixed
     */
    public function add(modelInterface $model);

    /**
     * @param $options
     * @return mixed
     */
    public function get($options);

    /**
     * @param $id
     * @return mixed
     */
    public function getAll($id);

    /**
     * @param $model
     * @return mixed
     */
    public function update($model);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param Database $db
     * @return mixed
     */
    public function setDb(Database $db);
}