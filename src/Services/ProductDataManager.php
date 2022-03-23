<?php

namespace App\Services;

use App\Services\Contracts\ProductDataWriterInterface;
use App\Services\Contracts\ProductFeedReaderInterface;
use App\Services\ProductDataWriter\CSVProductDataWriter;
use App\Services\ProductFeedReader\XMLProductFeedReader;

class ProductDataManager
{
    public static function reader($file): ProductFeedReaderInterface
    {
        return new XMLProductFeedReader($file);
    }

    public static function writer($file): ProductDataWriterInterface
    {
        return new CSVProductDataWriter($file);
    }
}