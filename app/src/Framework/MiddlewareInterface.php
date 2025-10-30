<?php

declare(strict_types=1);

namespace Framework;


//Blueprint for middleware classes
interface MiddlewareInterface
{
    public function process(Request $request, RequestHandlerInterface $next): Response;
}