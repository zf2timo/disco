# Upgrade to 0.5.0

## BC BREAK: Rasing minimum PHP version to 7.0

With the 0.5.0 release of Disco support for PHP 5.x is dropped. Disco
will only work in PHP 7.x environments since Disco relies on some of the
PHP 7.x features, e.g. return type definitions.

## BC BREAK: Return type definitions

Disco 0.5.0 dropped support for the @return annotations and strictly
relies on the return type definitions now. 

While this was valid configuration code before the 0.5.0 release:
```php
<?php

use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Helper\SampleService;

/**
 * @Configuration
 */
class MyConfiguration
{
    /**
     * @Bean
     * @return SampleService 
     */
    public function mySampleService()
    {
        return new SampleService();
    }
}
```

This is how you have to define bean instances for the 0.5.0 release:
```php
<?php

use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Helper\SampleService;

/**
 * @Configuration
 */
class MyConfiguration
{
    /**
     * @Bean
     */
    public function mySampleService() : SampleService
    {
        return new SampleService();
    }
}
```

Relying on return type definitions also fixes a few issues with traits
defined in different namespaces. PHP now can properly resolve these types
and we do no longer need to "guess" which type might be the correct one.

## BC BREAK: BeanFactoryConfiguration

The `\bitExpert\Disco\BeanFactoryConfiguration::__construct()` method 
signature changed. The constructor accepts just one parameter which 
defines the directory where the proxy classes and the annotation metadata
are stored. To configure a proxy autoloader instance or a proxy genrator
instance use the respective setter methods of the object.

## BC BREAK: Serialization of AnnotationBeanFactory

To make use of the session-aware beans it is no longer possible to serialize
the `\bitExpert\Disco\AnnotationBeanFactory` instance. Instead grab the 
`\bitExpert\Disco\Store\BeanStore` instance by calling 
`\bitExpert\Disco\BeanFactoryConfiguration::getSessionBeanStore()` and serialize
it. Pass the unserialized object to the `\bitExpert\Disco\BeanFactoryConfiguration`
before creating the `\bitExpert\Disco\AnnotationBeanFactory` instance.
