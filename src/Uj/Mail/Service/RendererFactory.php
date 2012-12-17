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
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Resolver\TemplateMapResolver;
use Uj\Mail\Exception\RuntimeException;

/**
 * Uj\Mail email service factory.
 *
 * @since 1.0
 * @package Uj\Mail\Service
 */
class RendererFactory implements
    FactoryInterface
{
    /**
     * Create, configure and return the email renderer.
     *
     * @see FactoryInterface::createService()
     * @return \Zend\View\Renderer\RendererInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        if (empty($config['uj']['mail']['renderer'])) {
            throw new RuntimeException(
                'Config required in order to create \Uj\Mail\Renderer.'.
                'required config key: $config["uj"]["mail"]["renderer"].'
            );
        }
        $rendererConfig = $config['uj']['mail']['renderer'];
        $resolver = new AggregateResolver();
        if (isset($rendererConfig['templateMap'])) {
            $resolver->attach(
                new TemplateMapResolver($rendererConfig['templateMap'])
            );
        }
        if (isset($rendererConfig['templatePathStack'])) {
            $pathStackResolver = new TemplatePathStack;
            $pathStackResolver->setPaths($rendererConfig['templatePathStack']);
            $resolver->attach($pathStackResolver);
        }
        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);
    }
}
