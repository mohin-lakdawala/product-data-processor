<?php

namespace App\Services\ProductFeedReader;

use App\Data\ProductData;
use App\Services\Contracts\ProductFeedReaderInterface;
use SimpleXMLElement;
use XMLReader;

class XMLProductFeedReader implements ProductFeedReaderInterface
{
    protected XMLReader $reader;

    public function __construct(public string $inputFile)
    {
        $this->reader = new XMLReader();
        $this->reader->open($this->inputFile);
    }

    public function getProduct(): ?ProductData
    {
        while ($this->reader->read()) {
            if ($this->reader->nodeType == XMLReader::ELEMENT && $this->reader->name == 'item') {

                $property = new SimpleXMLElement($this->reader->readOuterXML(), LIBXML_NOCDATA);

                return new ProductData(
                    entityId: (string) $property->entity_id,
                    categoryName: (string) $property->CategoryName,
                    sku: (string) $property->sku,
                    name: (string) $property->name,
                    description: (string) $property->description,
                    shortDescription: (string) $property->shortdesc,
                    price: (string) $property->price,
                    link: (string) $property->link,
                    image: (string) $property->image,
                    brand: (string) $property->Brand,
                    rating: (string) $property->Rating,
                    caffeineType: (string) $property->CaffeineType,
                    count: (string) $property->Count,
                    flavored: (string) $property->Flavored,
                    seasonal: (string) $property->Seasonal,
                    inStock: (string) $property->Instock,
                    facebook: (string) $property->Facebook,
                    isKCup: (string) $property->IsKCup,
                );
            }
        }

        return null;
    }

    public function __destruct()
    {
        $this->reader->close();
    }
}