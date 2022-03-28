<?php

namespace App\Tests\Services\ProductFeedReader;

use App\Services\ProductFeedReader\XMLProductFeedReader;
use PHPUnit\Framework\TestCase;

class XMLProductFeedReaderTest extends TestCase
{
    public function test_it_can_read_product_data_from_xml_file()
    {
        $reader = new XMLProductFeedReader('files/input.xml');
        $products = [];
        while ($data = $reader->getProduct()) {
            $products[] = $data;
        }

        $this->assertCount(12, $products);
    }
}