<?php

namespace App\Services\Contracts;

use App\Data\ProductData;

interface ProductDataWriterInterface
{
    public function saveProduct(ProductData $data): bool;
}