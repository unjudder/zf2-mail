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
use Uj\Mail\Exception\RuntimeException;

/**
 * Uj\Mail transport service factory.
 *
 * @since 0.1
 * @package Uj\Mail\Service
 */
class TransportFactory implements
    FactoryInterface
{
    /**
     * The default mail transport implementation namespace.
     *
     * @var string
     */
    const STD_TRANSPORT_NS = 'Zend\Mail\Transport';

    /**
     * Create, configure and return the email transport.
     *
     * @see FactoryInterface::createService()
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        if (empty($config['uj']['mail']['transport']['type'])) {
            throw new RuntimeException(
                'Config required in order to create \Uj\Mail\Transport.'.
                'required config key: $config["uj"]["mail"]["transport"].'
            );
        }

        $transportConfig = $config['uj']['mail']['transport'];
        $type = $transportConfig['type'];

        if (false === class_exists($type)) {
            $type = self::STD_TRANSPORT_NS . '\\' . ucfirst($type);
        }

        $transport = new $type;

        if (isset($transportConfig['options'])) {
            // by convention... SmtpOptions, SendmailOptions, etc..
            $optionsClass = $type . 'Options';
            $options = $transportConfig['options'];

            // create instance of options class if conventional
            // try succeeded, otherwise use what's in options
            if (class_exists($optionsClass)) {
                $options = new $optionsClass($options);
            }

            $transport->setOptions($options);
        }

        return $transport;
    }
}
