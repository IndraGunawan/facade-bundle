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
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;

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
        $facades = [];
        foreach ($container->findTaggedServiceIds('indragunawan.facade') as $id => $attr) {
            $class = $container->getDefinition($id)->getClass();
            $class = null !== $class ? $class : $id;

            if (!is_subclass_of($class, AbstractFacade::class)) {
                throw new InvalidArgumentException(sprintf('The service "%s" must extend AbstractFacade.', $class));
            }

            $r = new \ReflectionMethod($class, 'getFacadeAccessor');
            $r->setAccessible(true);
            $ref = $r->invoke(null);

            if (!\is_string($ref)) {
                throw new InvalidArgumentException(sprintf('Facade accessor must be string, "%s" given.', \is_object($ref) ? \get_class($ref) : \gettype($ref)));
            }

            $ref = \is_string($ref) && 0 === strpos($ref, '@') ? substr($ref, 1) : $ref;
            $facades[$id] = new Reference($ref);
        }

        $container->setAlias('indragunawan.facade.container', new Alias(ServiceLocatorTagPass::register($container, $facades), true));
    }
}
