<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle\Tests\DependencyInjection;

use Indragunawan\FacadeBundle\DependencyInjection\Compiler\AddFacadePass;
use Indragunawan\FacadeBundle\Tests\Fixtures\Facades\Foo;
use Indragunawan\FacadeBundle\Tests\Fixtures\Facades\InvalidFacade;
use Indragunawan\FacadeBundle\Tests\Fixtures\Facades\InvalidFacadeAccessor;
use Indragunawan\FacadeBundle\Tests\Fixtures\Services\FooService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class AddFacadePassTest extends TestCase
{
    public function testProsesFacade()
    {
        $container = new ContainerBuilder();

        $container->register(FooService::class);
        $container->register(Foo::class)->addTag('indragunawan.facade');

        $addFacadePass = new AddFacadePass();
        $addFacadePass->process($container);

        $container->compile();

        $this->assertInstanceOf(ServiceLocator::class, $container->get('indragunawan.facade.container'));
        $this->assertTrue($container->get('indragunawan.facade.container')->has(Foo::class));
    }

    public function testProcessInvalidFacadeAccessor()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Facade accessor must be string, "array" given.');

        $container = new ContainerBuilder();

        $container->register(InvalidFacadeAccessor::class)->addTag('indragunawan.facade');

        $addFacadePass = new AddFacadePass();
        $addFacadePass->process($container);

        $container->compile();
    }

    public function testProsesInvalidFacade()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The service "Indragunawan\FacadeBundle\Tests\Fixtures\Facades\InvalidFacade" must extend AbstractFacade.');

        $container = new ContainerBuilder();

        $container->register(InvalidFacade::class)->addTag('indragunawan.facade');

        $addFacadePass = new AddFacadePass();
        $addFacadePass->process($container);

        $container->compile();
    }
}
