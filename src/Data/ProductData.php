<?php

namespace App\Data;

class ProductData
{
    public function __construct(
        public string $entityId,
        public string $categoryName,
        public string $sku,
        public string $name,
        public string $description,
        public string $shortDescription,
        public string $price,
        public string $link,
        public string $image,
        public string $brand,
        public string $rating,
        public string $caffeineType,
        public string $count,
        public string $flavored,
        public string $seasonal,
        public string $inStock,
        public string $facebook,
        public string $isKCup,
    ) {}
}