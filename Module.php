<?php
/**
 * Unjudder Mail Module on top of Zendframework 2
 *
 * @link http://github.com/unjudder/zf2-mail for the canonical source repository
 * @copyright Copyright (c) 2012 unjudder
 * @license http://unjudder.com/license/new-bsd New BSD License
 * @package Uj\Mail
 */
namespace Uj\Mail;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Unjudder Mail Module
 *
 * @since 0.1
 * @package Uj\Mail
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    /**
     * The module's namespace
     *
     * @var string
     */
    const NS        = __NAMESPACE__;

    /**
     * The module's base path
     *
     * @var string
     */
    const BASE_PATH = __DIR__;

    /**
     * Return Uj\Mail autoload config.
     * 
     * @see     AutoloaderProviderInterface::getAutoloaderConfig()
     * @return  array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                self::BASE_PATH . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    self::NS => self::BASE_PATH . '/src/' . self::NS,
                )
            ),
        );
    }

    /**
     * Return the Uj\Mail module config.
     *
     * @see     ConfigProviderInterface::getConfig()
     * @return  array
     */
    public function getConfig()
    {
        return include self::BASE_PATH . '/config/module.config.php';
    }

    /**
     * Return the Uj\Mail service config.
     *
     * @see     ServiceProviderInterface::getServiceConfig()
     * @return  array
     */
    public function getServiceConfig()
    {
        return include self::BASE_PATH . '/config/service.config.php';
    }
}
