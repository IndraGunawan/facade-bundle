# FacadeBundle

[![license](https://img.shields.io/github/license/IndraGunawan/facade-bundle.svg?style=flat-square)](https://github.com/IndraGunawan/facade-bundle/blob/master/LICENSE.md)
[![Travis](https://img.shields.io/travis/IndraGunawan/facade-bundle.svg?style=flat-square)](https://travis-ci.org/IndraGunawan/facade-bundle)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/IndraGunawan/facade-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/IndraGunawan/facade-bundle/?branch=master)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/IndraGunawan/facade-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/IndraGunawan/facade-bundle/?branch=master)
[![Source](https://img.shields.io/badge/source-IndraGunawan%2Ffacade--bundle-blue.svg)](https://github.com/IndraGunawan/facade-bundle)
[![Packagist](https://img.shields.io/badge/packagist-indragunawan%2Ffacade--bundle-blue.svg)](https://packagist.org/packages/indragunawan/facade-bundle)

Support Facades for Symfony service.

thanks to:

- [Service Locator](https://symfony.com/blog/new-in-symfony-3-3-service-locators) - for making all the referenced facade service lazy-loaded.
- [Service Autoconfiguration](https://symfony.com/blog/new-in-symfony-3-3-service-autoconfiguration) - for making all classes that extend `Indragunawan\FacadeBundle\AbstractFacade` class automatically tagged as facade.

## Documentation

- [Installation](#installation)
- [Creating Facade](#creating-facade)

### Installation

If your project already uses Symfony Flex, execute this command to
download, register and configure the bundle automatically:

```bash
composer require indragunawan/facade-bundle
```

If you install without using Symfony Flex, first add the bundle by using composer then enable the bundle by adding `new Indragunawan\FacadeBundle\IndragunawanFacadeBundle()` to the list of registered bundles in the app/AppKernel.php file of your project

### Creating Facade

To create a facade create a class that extends base `Indragunawan\FacadeBundle\AbstractFacade` class and implement the `getFacadeAccessor` method that returns the `service id`, support **private** and **public** service.

```php
<?php

namespace App\Facades;

use Indragunawan\FacadeBundle\AbstractFacade;

class Foo extends AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Service\Foo'; // service id - supports private and public service.
    }
}
```

Now the facade now ready. Simply import the facade namespace. When you call any static method on the `Foo` facade, then it will resolve the service that you define in `getFacadeAccessor` method and call the requested method from the service.

## License

This bundle is under the MIT license. See the complete [license](LICENSE)