<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace  Indragunawan\FacadeBundle\DependencyInjection\Compiler;

use Indragunawan\FacadeBundle\AbstractFacade;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
final class AddFacadePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $services = [];
        foreach (array_keys($container->findTaggedServiceIds('indragunawan.facade')) as $id) {
            $class = $container->getDefinition($id)->getClass();
            if (!is_subclass_of($class, AbstractFacade::class)) {
                throw new InvalidArgumentException(sprintf('The service "%s" must extend AbstractFacade.', $class));
            }

            $ref = $class::getFacadeAccessor();
            if (!is_string($ref)) {
                throw new InvalidArgumentException(sprintf('Facade accessor must be string, "%s" given.', is_object($ref) ? get_class($ref) : gettype($ref)));
            }

            $ref = is_string($ref) && 0 === strpos($ref, '@') ? substr($ref, 1) : $ref;
            $services[$id] = new Reference($ref);
        }

        $serviceLocator = (new Definition(ServiceLocator::class))
            ->addArgument($services)
            ->setPublic(true)
            ->addTag('container.service_locator');

        $container->setDefinition('indragunawan.facade.container', $serviceLocator);
    }
}
