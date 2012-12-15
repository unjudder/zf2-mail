<?php
/**
 * Unjudder Mail Module on top of Zendframework 2
 *
 * @link http://github.com/unjudder/zf2-mail for the canonical source repository
 * @copyright Copyright (c) 2012 unjudder
 * @license http://unjudder.com/license/new-bsd New BSD License
 * @package Uj\Mail
 */
namespace Uj\Mail\Exception;

use \RuntimeException as BaseException;

/**
 * Uj\Mail runtime exception
 *
 * @since 0.2
 * @package Uj\Mail\Exception
 */
class RuntimeException extends BaseException implements
    ExceptionInterface
{
}
