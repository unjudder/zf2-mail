<?php
/**
 * Unjudder Mail Module on top of Zendframework 2
 *
 * @link http://github.com/unjudder/zf2-mail for the canonical source repository
 * @copyright Copyright (c) 2012 unjudder
 * @license http://unjudder.com/license/new-bsd New BSD License
 * @package Uj\Mail
 */
return array(
    'Uj\Mail\Service\EmailFactory'         => __DIR__ . '/src/Uj/Mail/Service/EmailFactory.php',
    'Uj\Mail\Service\RendererFactory'      => __DIR__ . '/src/Uj/Mail/Service/RendererFactory.php',
    'Uj\Mail\Service\Email'                => __DIR__ . '/src/Uj/Mail/Service/Email.php',
    'Uj\Mail\Service\TransportFactory'     => __DIR__ . '/src/Uj/Mail/Service/TransportFactory.php',
    'Uj\Mail\Exception\RuntimeException'   => __DIR__ . '/src/Uj/Mail/Exception/RuntimeException.php',
    'Uj\Mail\Exception\ExceptionInterface' => __DIR__ . '/src/Uj/Mail/Exception/ExceptionInterface.php'
);
