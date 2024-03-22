<?php

// This pattern can be transformed to an Adapter or Decorator patterns.

interface ProxyInterface
{
    public function request();
}

class Server implements ProxyInterface
{
    public function request(): string
    {
        return 'Server: Handling request.';
    }
}

abstract class Proxy implements ProxyInterface
{
    public function __construct(
        protected Server $server
    ) {
    }
}

class CachedProxy extends Proxy
{
    private string $cache;

    public function request(): string
    {
        if (empty($this->cache)) {
            $this->cache = $this->server->request();
        }

        return $this->cache;
    }
}

class LoggerProxy extends Proxy
{
    public function request(): string
    {
        $result = $this->server->request();
        echo "Logger: Request has been logged.\n";

        return $result;
    }
}

class AuthenticationProxy extends Proxy
{
    public function request(): string
    {
        return 'AuthenticationProxy: Unauthorized request.';
    }
}