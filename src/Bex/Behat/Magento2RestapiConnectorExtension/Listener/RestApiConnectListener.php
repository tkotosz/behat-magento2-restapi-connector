<?php

namespace Bex\Behat\Magento2RestapiConnectorExtension\Listener;

use Behat\Testwork\EventDispatcher\Event\SuiteTested;
use Bex\Behat\Magento2RestapiConnectorExtension\ServiceContainer\Config;
use Bex\Behat\Magento2RestapiConnectorExtension\Service\RestApi;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class RestApiConnectListener implements EventSubscriberInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            SuiteTested::BEFORE => 'connectToApi'
        ];
    }

    public function connectToApi()
    {
        RestApi::getInstance()->connect(
            $this->config->getApiUrl(),
            $this->config->getApiUser(),
            $this->config->getApiPassword()
        );
    }
}
