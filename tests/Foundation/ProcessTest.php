<?php

namespace Chanshige\Foundation;

use Chanshige\CommonTestCase;

/**
 * Class ProcessTest
 *
 * @package Chanshige\Foundation
 */
class ProcessTest extends CommonTestCase
{
    private $process;

    protected function setUp()
    {
        $this->process = (new Process())(['/usr/bin/which', 'php']);
    }

    public function testRun()
    {
        $this->process->run();
        $this->assertTrue($this->process->isSuccessful());
        $this->assertEquals(0, $this->process->getExitCode());
        $this->assertEquals('OK', $this->process->getExitCodeText());
        $this->assertEquals('/usr/local/bin/php' . "\n", $this->process->getOutput());
    }

    /**
     * @expectedException Chanshige\Foundation\Exception\ExecutionException
     * @expectedExceptionMessage Process must be started before calling getOutput.
     */
    public function testWithoutRun()
    {
        $this->assertFalse($this->process->isSuccessful());
        $this->assertEquals(ProcessInterface::NOT_TERMINATED_CODE, $this->process->getExitCode());
        $this->assertEquals('', $this->process->getExitCodeText());
        // ExecutionException
        $this->process->getOutput();
    }

    public function testGetCommandLine()
    {
        $this->assertEquals('\'/usr/bin/which\' \'php\'', $this->process->getCommandLine());
    }
}