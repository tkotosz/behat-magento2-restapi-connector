<?php

namespace Bex\Behat\Magento2RestapiConnectorExtension\Service;

class RestApi
{
    const API_URL_GET_TOKEN = '/V1/integration/admin/token';

    /**
     * @var RestApi
     */
    private static $instance;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var stdClass
     */
    private $apiToken;

    /**
     * @param Config $config
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param  string $apiUrl
     * @param  string $apiUser
     * @param  string $apiPass
     *
     * @return void
     */
    public function connect($apiUrl, $apiUser, $apiPass)
    {
        $this->apiUrl = $apiUrl;
        $ch = curl_init($this->createRequestUrl(self::API_URL_GET_TOKEN));
        $data = json_encode(["username" => $apiUser, "password" => $apiPass]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($data)]);
        $this->apiToken = json_decode(curl_exec($ch));
    }

    /**
     * Returns json result of the api call
     * 
     * @param  string $path
     * @param  string $params
     *
     * @return string
     */
    public function get($path, $params = '')
    {
        $ch = curl_init($this->createRequestUrl($path, $params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->apiToken]); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   

        return curl_exec($ch);
    }

    /**
     * @param  string $path
     * @param  string $params
     *
     * @return string
     */
    private function createRequestUrl($path, $params = '')
    {
        $baseUrl = rtrim($this->apiUrl, '/');
        $path = trim($path, '/');
        $params = trim($params, '/');

        return $baseUrl . '/' . $path . '/' . $params;
    }
}
