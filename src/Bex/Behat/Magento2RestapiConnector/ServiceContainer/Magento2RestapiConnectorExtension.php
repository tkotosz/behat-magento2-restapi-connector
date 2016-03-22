<?php

namespace Bex\Behat\Magento2RestapiConnector\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Bex\Behat\Magento2RestapiConnector\ServiceContainer\Config;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Magento2RestapiConnectorExtension implements Extension
{
    const CONFIG_KEY = 'magento2restapiconnector';

     /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return self::CONFIG_KEY;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        // nothing to do here
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
        // nothing to do here
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode(Config::CONFIG_KEY_API_URL)->end()
                ->scalarNode(Config::CONFIG_KEY_API_USER)->end()
                ->scalarNode(Config::CONFIG_KEY_API_PASS)->end()
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/config'));
        $loader->load('services.xml');

        $extensionConfig = new Config($config);
        $container->set('bex.magento2_restapi_connector.config', $extensionConfig);
    }
}
