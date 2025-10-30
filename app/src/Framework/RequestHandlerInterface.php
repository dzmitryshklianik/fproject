<?php

declare(strict_types=1);

namespace Framework;

//Blueprint for request handler classes
interface RequestHandlerInterface
{
    public function handle(Request $request): Response;
}