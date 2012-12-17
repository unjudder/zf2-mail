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
    'factories' => array(
        'Uj\Mail\Email' => 'Uj\Mail\Service\EmailFactory',
        'Uj\Mail\Renderer' => 'Uj\Mail\Service\RendererFactory',
        'Uj\Mail\Transport' => 'Uj\Mail\Service\TransportFactory'
    )
);
