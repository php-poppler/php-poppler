<?php

/*
 * This file is part of php-poppler.
 *
 * (c) Stephan Wentz <stephan@wentz.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Poppler\Exception;

/**
 * Poppler executable not found exception
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class ExecutableNotFoundException extends \RuntimeException implements ExceptionInterface
{
}
