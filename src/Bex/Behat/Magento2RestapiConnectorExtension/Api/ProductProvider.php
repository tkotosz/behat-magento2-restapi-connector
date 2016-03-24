<?php

namespace Bex\Behat\Magento2RestapiConnectorExtension\Api;

use Bex\Behat\Magento2RestapiConnectorExtension\Service\RestApi;

class ProductProvider
{
    const API_PATH = '/V1/products';

    /**
     * @param  string $sku
     * @param  string $dataKey
     *
     * @return string|array
     */
    public function getProductDataBySku($sku, $dataKey = '')
    {
        $result = RestApi::getInstance()->get(self::API_PATH, $sku);
        $productData = json_decode($result, true);

        if ($dataKey) {
            return $productData[$dataKey];
        }

        return $productData;
    }
}
