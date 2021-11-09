<?php

namespace App\Component\ProductGtinProvider;

use App\Component\ProductGtinProvider\TransferObject\ProductGtin;
use Generator;

interface ProductGtinsProviderInterface
{
    /**
     * @return ProductGtin[]|Generator
     */
    public function provide(): iterable;
}
