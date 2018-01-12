<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle;

use Psr\Container\ContainerInterface;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
abstract class AbstractFacade
{
    protected static $container;

    public static function setFacadeContainer(ContainerInterface $container)
    {
        static::$container = $container;
    }

    public static function getFacadeAccessor()
    {
        throw new \RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    public static function __callStatic($method, $arguments)
    {
        $class = get_called_class();

        if (!static::$container->has($class)) {
            throw new \RuntimeException(sprintf('"%s" facade has not been register.', $class));
        }

        $service = static::$container->get($class);

        return $service->$method(...$arguments);
    }
}
