<?php

namespace AppModule\Model;


use Core\Database\Database;

interface iDAO
{
    public function add(iModel $model);

    public function get($options);

    public function getAll($id);

    public function update($model);

    public function delete($id);

    public function setDb(Database $db);
}