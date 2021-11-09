<?php

namespace App\Component\ProductGtinProvider\Denormalizer;

use App\Component\ProductGtinProvider\TransferObject\ProductGtin;

class ProductGtinsDenormalizer
{
    /**
     * @param mixed[] $product
     */
    public function denormalize(array $product): iterable
    {
        yield new ProductGtin(
            $product['gtin'],
            $product['title']
        );
    }
}
