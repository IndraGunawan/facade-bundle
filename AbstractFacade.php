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

    /**
     * Facade service container.
     *
     * @param ContainerInterface $container
     */
    public static function setFacadeContainer(ContainerInterface $container)
    {
        static::$container = $container;
    }

    /**
     * Get the registered id of the service.
     *
     * @return string
     */
    abstract public static function getFacadeAccessor();

    /**
     * Handle dynamic calls to the service.
     *
     * @param string $method
     * @param string $arguments
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
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
