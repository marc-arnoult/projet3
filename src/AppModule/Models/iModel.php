<?php

namespace AppModule\Model;


interface iModel
{
    /**
     * @param array $array
     * @return mixed
     */
    public function hydrate(array $array);
}