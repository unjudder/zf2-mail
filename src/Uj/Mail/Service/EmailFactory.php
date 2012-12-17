<?php
/**
 * Unjudder Mail Module on top of Zendframework 2
 *
 * @link http://github.com/unjudder/zf2-mail for the canonical source repository
 * @copyright Copyright (c) 2012 unjudder
 * @license http://unjudder.com/license/new-bsd New BSD License
 * @package Uj\Mail
 */
namespace Uj\Mail\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Uj\Mail email service factory.
 *
 * @since 1.0
 * @package Uj\Mail\Service
 */
class EmailFactory implements
    FactoryInterface
{
    /**
     * Create, configure and return the email transport.
     *
     * @see FactoryInterface::createService()
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $transport = $serviceLocator->get('Uj\Mail\Transport');
        $renderer  = $serviceLocator->get('Uj\Mail\Renderer');

        return new Email($transport, $renderer);
    }
}
