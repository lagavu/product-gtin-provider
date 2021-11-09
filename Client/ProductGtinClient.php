<?php

namespace App\Component\ProductGtinProvider\Client;

use App\Component\ProductGtinProvider\Exception\BadResponseProductGtinClientException;
use GuzzleHttp\ClientInterface;

class ProductGtinClient
{
    private const PRODUCT_GTIN_URL = 'http://markirovka.cluster.med.local/products';
    private const REQUEST_TIMEOUT = 10;

    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return mixed[]
     */
    public function getProducts(): array
    {
        $requestProductsInformation = $this->requestProductsInformation();

        return $requestProductsInformation['payload']['products'];
    }

    private function requestProductsInformation()
    {
        $response = $this->httpClient->request(
            'GET',
            self::PRODUCT_GTIN_URL,
            [
                'timeout' => self::REQUEST_TIMEOUT,
            ]
        );

        $responseData = json_decode($response->getBody()->getContents(), true);

        self::assertSuccessResponse($responseData);

        return $responseData;
    }

    /**
     * @param mixed[] $responseData
     */
    private static function assertSuccessResponse(array $responseData): void
    {
        if (!array_key_exists('ok', $responseData) && !$responseData['ok']) {
            throw new BadResponseProductGtinClientException('Failed to get correct response from product gtin client.');
        }
    }
}
