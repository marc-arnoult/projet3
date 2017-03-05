<?php

namespace AppModule\Model;


use Core\Database\Database;

interface iDAO
{
    public function add($model);

    public function get($cond);

    public function getAll($cond);

    public function update();

    public function delete();

    public function setDb(Database $db);
}