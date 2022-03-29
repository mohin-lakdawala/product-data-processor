<?php

namespace App\Command;

use App\Services\Contracts\ProductDataWriterInterface;
use App\Services\Contracts\ProductFeedReaderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessProductDataCommand extends Command
{
    public string $outputFile = 'files/output.csv';
    protected static $defaultName = 'app:process-product-data';

    public function __construct(
        protected ProductFeedReaderInterface $reader,
        protected ProductDataWriterInterface $writer,
    ) {
        parent::__construct(self::$defaultName);
    }

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

        $this->reader->setFile($inputFile);
        $this->writer->setFile($this->outputFile);

        while ($data = $this->reader->getProduct()) {
            $this->writer->saveProduct($data);
        }

        $output->writeln('Process complete!');

        return Command::SUCCESS;
    }
}