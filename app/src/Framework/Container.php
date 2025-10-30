<?php

declare(strict_types=1);


namespace Framework;

use ReflectionClass;
use Closure;
use InvalidArgumentException;
use ReflectionNamedType;

class Container
{
    private array $registry = [];

    //Write behavior for get method for class
    public function set(string $name, Closure $value): void
    {
        $this->registry[$name] = $value;
    }

    //Search saved behavior or create default without null or combined params
    //return exemplar of class with set definitions
    public function get(string $class_name): object
    {
        if (array_key_exists($class_name, $this->registry)) {
            return $this->registry[$class_name]();
        }

        $reflection = new ReflectionClass($class_name);

        $constructor = $reflection->getConstructor();

        $dependencies = [];

        if ($constructor === null) {
            return new $class_name;
        }
        foreach ($constructor->getParameters() as $param) {

            $type = $param->getType();

            if ($type === null) {

                throw new InvalidArgumentException("Constructor parameter '{$param->getName()}'
                 in the $class_name class
                 has no type declaration.");
            }

            if (!($type instanceof ReflectionNamedType)) {

                throw new InvalidArgumentException("Constructor parameter '{$param->getName()}'
                in the $class_name class is an invalid type: '$type'
                - only single named types supported.");

            }

            if ($type->isBuiltin()) {

                throw new InvalidArgumentException("Unable to resolve constructor parameter 
                '{$param->getName()}'
                 of type '$type' in the $class_name class");
            }

            $dependencies[] = $this->get((string)$type);

        }

        return new $class_name(...$dependencies);
    }
}