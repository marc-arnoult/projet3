<?php

namespace AppModule\Model;


use Core\Database\Database;
use Core\Database\RedisCache;

interface iDAO
{
    public function __construct(Database $db, RedisCache $cache);

    /**
     * @param iModel $model
     * @return mixed
     */
    public function add(iModel $model);

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