<?php

declare (strict_types=1);
namespace Symplify\SymfonyPhpConfig\Reflection;

use RectorPrefix20210510\Symplify\PackageBuilder\Reflection\PrivatesAccessor;
final class ArgumentAndParameterFactory
{
    /**
     * @var PrivatesAccessor
     */
    private $privatesAccessor;
    public function __construct()
    {
        $this->privatesAccessor = new PrivatesAccessor();
    }
    /**
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $properties
     * @return object
     */
    public function create(string $className, array $arguments, array $properties)
    {
        $object = new $className(...$arguments);
        foreach ($properties as $name => $value) {
            $this->privatesAccessor->setPrivateProperty($object, $name, $value);
        }
        return $object;
    }
}