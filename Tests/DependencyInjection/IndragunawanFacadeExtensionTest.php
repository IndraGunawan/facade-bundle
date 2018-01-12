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

use Indragunawan\FacadeBundle\AbstractFacade;
use Indragunawan\FacadeBundle\DependencyInjection\IndragunawanFacadeExtension;
use Indragunawan\FacadeBundle\Tests\Fixtures\Facades\Foo;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class IndragunawanFacadeExtensionTest extends TestCase
{
    public function testRegisterAutoconfigure()
    {
        $container = new ContainerBuilder();
        $container->register(Foo::class);

        $extension = new IndragunawanFacadeExtension();
        $extension->load([], $container);

        $this->assertArrayHasKey(AbstractFacade::class, $container->getAutoconfiguredInstanceof());
        $this->assertArrayHasKey('indragunawan.facade', $container->getAutoconfiguredInstanceof()[AbstractFacade::class]->getTags());
    }
}
