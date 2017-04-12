<?php

namespace Core\Database;

interface CacheInterface
{
    /**
     * @param $keys
     * @return string
     */
    public function hashKeys($keys);

    /**
     * @param $key
     * @return string
     */
    public function hashKey($key);

    /**
     * Cache into redis instance with the key associte with it if the key exist it return the cache else this will
     * be cached into redis.
     *
     * @param $keys
     * @param callable $callback
     * @return mixed|string
     */
    public function cache($keys, Callable $callback);

    /**
     * @param $key
     */
    public function del($key);
}