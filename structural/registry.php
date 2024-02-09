<?php

abstract class Registry
{
    private static array $data = [];

    final public static function set($key, Service $service): void
    {
        self::$data[$key] = $service;
    }

    final public static function get($key): Service|null
    {
        return self::$data[$key] ?? null;
    }
}

class Service
{
}

$service = new Service();
Registry::set('my_service', $service);

var_dump(Registry::get('my_service'));