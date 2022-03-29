<?php

namespace App\Tests\Services\ProductDataWriter;

use App\Data\ProductData;
use App\Services\ProductDataWriter\CSVProductDataWriter;
use PHPUnit\Framework\TestCase;

class CSVProductDataWriterTest extends TestCase
{
    public function test_it_can_parse_correct_data_to_save()
    {
        $writer = new CSVProductDataWriter();
        $writer->setFile('output.csv');
        $dataToSave = $writer->getDataToSave($this->getSampleProductData());

        $this->assertCount(18, $dataToSave);
    }

    public function test_it_can_save_data_to_csv()
    {
        $writer = new CSVProductDataWriter();
        $writer->setFile('files/output.csv');
        $writer->saveProduct($this->getSampleProductData());

        $this->assertFileExists(realpath('files/output.csv'));
        $this->assertFileEquals(realpath('files/expected_output.csv'), realpath('files/output.csv'));
    }

    protected function getSampleProductData()
    {
        return new ProductData(
            'entityId',
            'categoryName',
            'sku',
            'name',
            'description',
            'shortDescription',
            'price',
            'link',
            'image',
            'brand',
            'rating',
            'caffeineType',
            'count',
            'flavored',
            'seasonal',
            'inStock',
            'facebook',
            'isKCup',
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        @unlink(realpath('files/output.csv'));
    }
}