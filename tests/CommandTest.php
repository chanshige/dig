<?php

namespace Chanshige;

class CommandTest extends CommonTestCase
{
    public function testCommand()
    {
        $command = new Command();
        $command->domain('domains.example')
            ->qType('mx')
            ->globalServer('127.0.0.1');

        $expected = <<<EOF
array (
  0 => '/usr/bin/dig',
  1 => '@127.0.0.1',
  2 => 'domains.example',
  3 => 'mx',
  4 => '+noall',
  5 => '+nocmd',
  6 => '+ans',
  7 => '+additional',
  8 => '+authority',
  9 => '+timeout=1',
)
EOF;

        $this->assertEquals($expected, (string)$command);
    }

    public function testChangePath()
    {
        $command = new Command();
        $command->domain('domains.example')
            ->path('/path/to/dig')
            ->qType('aaaa')
            ->globalServer('192.168.0.1');

        $expected = <<<EOF
array (
  0 => '/path/to/dig',
  1 => '@192.168.0.1',
  2 => 'domains.example',
  3 => 'aaaa',
  4 => '+noall',
  5 => '+nocmd',
  6 => '+ans',
  7 => '+additional',
  8 => '+authority',
  9 => '+timeout=1',
)
EOF;

        $this->assertEquals($expected, (string)$command);
    }
}
