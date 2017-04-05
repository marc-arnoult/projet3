<?php

namespace AppModule\Model;


interface modelInterface
{
    /**
     * @param array $array
     * @return mixed
     */
    public function hydrate(array $array);
}