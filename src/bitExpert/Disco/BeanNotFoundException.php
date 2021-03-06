<?php

/*
 * This file is part of the Disco package.
 *
 * (c) bitExpert AG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace bitExpert\Disco;

use Interop\Container\Exception\NotFoundException;

/**
 * Exception being thrown if called / referenced bean doesn't exist in the
 * {@link \bitExpert\Disco\BeanFactory}.
 */
class BeanNotFoundException extends BeanException implements NotFoundException
{
}
