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

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class InvalidFacade
{
    public static function getFacadeAccessor()
    {
        return ['array'];
    }
}
