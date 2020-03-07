<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle\Tests\Fixtures;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class Kernel extends BaseKernel
{
    public function registerBundles()
    {
        return [
            new \Indragunawan\FacadeBundle\IndragunawanFacadeBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        return null;
    }
}
