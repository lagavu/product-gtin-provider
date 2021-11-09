<?php

namespace App\Component\ProductGtinProvider;

use App\Component\ProductGtinProvider\Client\ProductGtinClient;
use App\Component\ProductGtinProvider\Denormalizer\ProductGtinsDenormalizer;
use App\Component\ProductGtinProvider\TransferObject\ProductGtin;
use Generator;

class ProductGtinsProvider implements ProductGtinsProviderInterface
{
    private $productGtinClient;
    private $productGtinsDenormalizer;

    public function __construct(ProductGtinClient $productGtinClient, ProductGtinsDenormalizer $productGtinsDenormalizer)
    {
        $this->productGtinClient = $productGtinClient;
        $this->productGtinsDenormalizer = $productGtinsDenormalizer;
    }

    /**
     * @return ProductGtin[]|Generator
     */
    public function provide(): iterable
    {
        $products = $this->productGtinClient->getProducts();

        foreach ($products as $product) {
            yield from $this->productGtinsDenormalizer->denormalize($product);
        }
    }
}
