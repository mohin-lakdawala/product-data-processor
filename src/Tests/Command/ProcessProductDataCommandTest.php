<?php

namespace App\Tests\Command;

use App\Command\ProcessProductDataCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProcessProductDataCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new ProcessProductDataCommand());

        $command = $application->find('app:process-product-data');
        $command->outputFile = '../output.csv';
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'input-file' => realpath('../sample_input.xml'),
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertFileExists(realpath('../output.csv'));
        $this->assertFileEquals(realpath('../expected_output.csv'), realpath('../output.csv'));
        $this->assertStringContainsString('Process complete!', $output);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        @unlink(realpath('../output.csv'));
    }
}