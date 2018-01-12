<?php

/*
 * This file is part of the FacadeBundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\FacadeBundle\Tests\Fixtures\Services;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class FooService
{
    public function sayHello()
    {
        return 'hello';
    }

    public function callWithArgs($bar, $foo)
    {
        return [$bar, $foo];
    }
}
