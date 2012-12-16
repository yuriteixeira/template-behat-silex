<?php

namespace Api\Test;

use Symfony\Component\Console\Input\ArrayInput;
use Behat\Behat\Console\BehatApplication;
use Symfony\Component\Console\Output\ConsoleOutput;

class BehatTest extends \PHPUnit_Framework_TestCase
{
    public function testThatBehatScenariosMeetAcceptanceCriteria()
    {
        try {

            $input = new ArrayInput(array('--format' => 'progress', '-v' => ''));
            $output = new ConsoleOutput();

            $app = new BehatApplication('DEV');
            $app->setAutoExit(false);

            $result = $app->run($input, $output);
            $this->assertEquals(0, $result);

        } catch (\Exception $exception) {

            $this->fail($exception->getMessage());
        }
    }
}
