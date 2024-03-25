<?php

// This pattern variant is closer to Information Expert Principle with a separate Router class witch contains the middleware chain instead of the middleware chain being a part of the middleware itself.

abstract class HandlerMiddleware
{
    abstract public function shouldHandle(string $request): bool;

    abstract public function handle(): string;
}

class AuthMiddleware extends HandlerMiddleware
{
    #[\Override] public function shouldHandle(string $request): bool
    {
        return $request === 'auth';
    }

    #[\Override] public function handle(): string
    {
        return 'Authenticated.';
    }
}

class LoggerMiddleware extends HandlerMiddleware
{
    #[\Override] public function shouldHandle(string $request): bool
    {
        return $request === 'log';
    }

    #[\Override] public function handle(): string
    {
        return 'Logged request.';
    }
}

class RoleCheckMiddleware extends HandlerMiddleware
{
    #[\Override] public function shouldHandle(string $request): bool
    {
        return $request === 'role';
    }

    #[\Override] public function handle(): string
    {
        return 'Role check passed.';
    }
}

class ErrorHandlerMiddleware extends HandlerMiddleware
{
    #[\Override] public function shouldHandle(string $request): bool
    {
        return true;
    }

    /**
     * @throws Exception
     */
    #[\Override] public function handle(): string
    {
        throw new \Exception('Middlewares chain error occurred.');
    }
}

class Router
{
    private array $middlewares = [];

    public function addMiddleware(HandlerMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handleRequest(string $request): string
    {
        try {
            foreach ($this->middlewares as $middleware) {
                if ($middleware->shouldHandle($request)) {
                    return $middleware->handle();
                }
            }
        } catch (\Exception $e) {
            return 'Error occurred: ' . $e->getMessage();
        }

        return 'Request not handled.';
    }
}

$router = new Router();

$router->addMiddleware(new AuthMiddleware());
$router->addMiddleware(new LoggerMiddleware());
$router->addMiddleware(new RoleCheckMiddleware());
$router->addMiddleware(new ErrorHandlerMiddleware());

$result = $router->handleRequest('not-handled-request');

echo $result;