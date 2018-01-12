<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle\Tests;

use Indragunawan\FacadeBundle\AbstractFacade;
use Indragunawan\FacadeBundle\Tests\Fixtures\Facades\Foo;
use Indragunawan\FacadeBundle\Tests\Fixtures\Services\FooService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class FacadeTest extends TestCase
{
    public function testRegisteredFacade()
    {
        $container = $this->createMock(ServiceLocator::class);
        $container
            ->expects($this->exactly(2))
            ->method('has')
            ->will($this->returnValueMap([
                [Foo::class, true],
            ]))
        ;

        $container
            ->expects($this->exactly(2))
            ->method('get')
            ->will($this->returnValueMap([
                [Foo::class, new FooService()],
            ]))
        ;

        AbstractFacade::setFacadeContainer($container);

        $fooService = new FooService();
        $this->assertSame($fooService->sayHello(), Foo::sayHello());
        $this->assertSame($fooService->callWithArgs('foo', 'bar'), Foo::callWithArgs('foo', 'bar'));
    }

    public function testNotRegisteredFacade()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(sprintf('"%s" facade has not been register.', Foo::class));

        $container = $this->createMock(ServiceLocator::class);
        $container
            ->expects($this->once())
            ->method('has')
            ->will($this->returnValueMap([]))
        ;

        AbstractFacade::setFacadeContainer($container);

        $fooService = new FooService();
        Foo::sayHello();
    }
}
