<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle\Tests\Fixtures\Facades;

use Indragunawan\FacadeBundle\AbstractFacade;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class Foo extends AbstractFacade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return 'Indragunawan\FacadeBundle\Tests\Fixtures\Services\FooService';
    }
}
