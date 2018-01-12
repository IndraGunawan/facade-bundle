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

use Indragunawan\FacadeBundle\IndragunawanFacadeBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class IndragunawanFacadeBundleTest extends TestCase
{
    public function testBundle()
    {
        $kernel = $this->getKernel();
        $kernel->boot();

        $this->assertTrue($kernel->getContainer()->has('indragunawan.facade.container'));
        $this->assertInstanceOf(ServiceLocator::class, $kernel->getContainer()->get('indragunawan.facade.container'));
    }

    protected function getKernel()
    {
        $kernel = $this
            ->getMockBuilder(Kernel::class)
            ->setMethods(['registerBundles'])
            ->setConstructorArgs(['test', false])
            ->getMockForAbstractClass()
        ;
        $kernel->method('registerBundles')
            ->will($this->returnValue([new IndragunawanFacadeBundle()]))
        ;
        $p = new \ReflectionProperty($kernel, 'rootDir');
        $p->setAccessible(true);
        $p->setValue($kernel, sys_get_temp_dir());

        return $kernel;
    }
}
