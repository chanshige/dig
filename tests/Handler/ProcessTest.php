<?php

namespace Chanshige\Handler;

use Chanshige\CommonTestCase;
use Chanshige\Exception\DigExecutionException;

class ProcessTest extends CommonTestCase
{
    /** @var ProcessInterface */
    private $process;

    protected function setUp()
    {
        $this->process = (new Process())->command(['/usr/bin/which', 'ls']);
    }

    public function testRun()
    {
        $this->process->run();
        $this->assertTrue($this->process->isSuccessful());
        $this->assertEquals(0, $this->process->exitCode());
        $this->assertEquals('OK', $this->process->exitCodeText());
        $this->assertEquals('/bin/ls' . "\n", $this->process->output());
    }

    public function testWithoutRun()
    {
        $this->expectException(DigExecutionException::class);
        $this->expectExceptionMessage('Process must be started before calling getOutput.');
        $this->assertFalse($this->process->isSuccessful());
        $this->assertEquals(null, $this->process->exitCode());
        $this->assertEquals('', $this->process->exitCodeText());
        // ExecutionException
        $this->process->output();
    }

    public function testGetCommandLine()
    {
        $this->assertEquals('\'/usr/bin/which\' \'ls\'', $this->process->commandLine());
    }
}
