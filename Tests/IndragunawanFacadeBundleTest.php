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

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class IndragunawanFacadeBundleTest extends KernelTestCase
{
    public function testBundle()
    {
        $kernel = $this->bootKernel(['environment' => 'test', 'debug' => true]);

        $this->assertTrue($kernel->getContainer()->has('indragunawan.facade.container'));
        $this->assertInstanceOf(ServiceLocator::class, $kernel->getContainer()->get('indragunawan.facade.container'));
    }
}
