<?php

namespace Bex\Behat\BrowserInitialiserExtension\ServiceContainer;

class Config
{
    const CONFIG_KEY_API_URL = 'api_url';
    const CONFIG_KEY_API_USER = 'api_user';
    const CONFIG_KEY_API_PASS = 'api_password';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiUser;

    /**
     * @var string
     */
    private $apiPass;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->apiUrl = $config[self::CONFIG_KEY_API_URL];
        $this->apiUser = $config[self::CONFIG_KEY_API_USER];
        $this->apiPass = $config[self::CONFIG_KEY_API_PASS];
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return rtrim($this->apiUrl, '/');
    }

    /**
     * @return string
     */
    public function getApiUser()
    {
        return $this->apiUser;
    }

    /**
     * @return string
     */
    public function getApiPassword()
    {
        return $this->apiPass;
    }
}
