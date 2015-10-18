<?php

namespace Test;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class BehatTest extends \PHPUnit_Framework_TestCase
{
    public function testThatBehatScenariosMeetAcceptanceCriteria()
    {
        try {
            $input = new ArrayInput(array('-v' => ''));
            $output = new ConsoleOutput();

            $factory = new \Behat\Behat\ApplicationFactory();
            $app = $factory->createApplication();
            $app->setAutoExit(false);

            $result = $app->run($input, $output);
            $this->assertEquals(0, $result);
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }
    }
}
