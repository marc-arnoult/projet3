<?php

namespace AppModule\Model;


use Core\Database\Database;

interface iDAO
{
    public function add(iModel $model);

    public function get($id);

    public function getAll();

    public function update();

    public function delete();

    public function setDb(Database $db);
}