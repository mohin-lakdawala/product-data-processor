<?php

namespace App\Services\ProductDataWriter;

use App\Data\ProductData;
use App\Services\Contracts\ProductDataWriterInterface;

class CSVProductDataWriter implements ProductDataWriterInterface
{
    protected $file;

    public function setFile(string $file): void
    {
        $this->file = fopen($file, "w");
    }

    public function saveProduct(ProductData $data): bool
    {
        fputcsv($this->file, $this->getDataToSave($data));

        return true;
    }

    public function getDataToSave(ProductData $data): array
    {
        return [
            $data->entityId,
            $data->categoryName,
            $data->sku,
            $data->name,
            $data->description,
            $data->shortDescription,
            $data->price,
            $data->link,
            $data->image,
            $data->brand,
            $data->rating,
            $data->caffeineType,
            $data->count,
            $data->flavored,
            $data->seasonal,
            $data->inStock,
            $data->facebook,
            $data->isKCup,
        ];
    }

    public function __destruct()
    {
        fclose($this->file);
    }
}