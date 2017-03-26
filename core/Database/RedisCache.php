<?php
namespace Core\Database;

use Predis\Client;

class RedisCache {
    private $client;

    public function __construct()
    {
        $this->client = new Client(array('host' => 'redis'));
    }

    public function remember($key, $minutes, Callable $callback)
    {
        if ($value = $this->client->get($key)) {
            return unserialize($value);
        }

        $this->client->setex($key, $minutes, $value = serialize($callback()));

        return unserialize($value);
    }
}