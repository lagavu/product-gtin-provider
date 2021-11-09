<?php

namespace App\Component\ProductGtinProvider\TransferObject;

class ProductGtin
{
    private $gtin;
    private $title;

    public function __construct(string $gtin, string $title)
    {
        $this->gtin = $gtin;
        $this->title = $title;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
