<?php

namespace App\Command;

use App\Services\Contracts\ProductDataWriterInterface;
use App\Services\Contracts\ProductFeedReaderInterface;
use App\Services\ProductDataManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessProductDataCommand extends Command
{
    public ProductFeedReaderInterface $reader;
    public ProductDataWriterInterface $writer;
    public string $outputFile = 'files/output.csv';

    public function configure()
    {
        $this
            ->setName('app:process-product-data')
            ->setDescription('Processes the product data present in the input file.')
            ->addArgument(
            'input-file',
            InputArgument::REQUIRED,
            'The input file path or URI that needs to be processed.'
        );
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = $input->getArgument('input-file');

        $output->writeln('Process starts!');
        $output->writeln($inputFile);

        $this->reader = ProductDataManager::reader($inputFile);
        $this->writer = ProductDataManager::writer($this->outputFile);

        while ($data = $this->reader->getProduct()) {
            $this->writer->saveProduct($data);
        }

        $output->writeln('Process complete!');

        return Command::SUCCESS;
    }
}