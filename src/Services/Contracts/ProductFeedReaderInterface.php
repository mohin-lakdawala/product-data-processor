<?php

namespace App\Services\Contracts;

use App\Data\ProductData;

interface ProductFeedReaderInterface
{
    public function getProduct(): ?ProductData;
}