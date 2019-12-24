<?php

namespace Chanshige\Fake;

use Chanshige\Foundation\ProcessInterface;

/**
 * Class Process
 *
 * @package Chanshige\Fake
 */
class Process implements ProcessInterface
{
    private $isRun = false;

    private $commandLine = [];

    private $code = 0;

    private $forceFailed;

    public function __construct($forceFailed = false)
    {
        $this->forceFailed = $forceFailed;
    }

    public function command(array $command): ProcessInterface
    {
        $this->commandLine = $command;

        return $this;
    }

    public function run(): int
    {
        $this->isRun = true;

        return $this->code;
    }

    public function isSuccessful(): bool
    {
        if ($this->forceFailed) {
            return false;
        }

        return $this->isRun;
    }

    public function getExitCode(): int
    {
        return $this->code;
    }

    public function getExitCodeText(): string
    {
        return 'exit code text.';
    }

    public function getOutput(): string
    {
        return self::fakeResult();
    }

    public function getCommandLine(): string
    {
        return implode(' ', $this->commandLine);
    }

    public static function fakeResult()
    {
        return <<< EOF

; <<>> DiG 9.11-Debian <<>> @8.8.8.8 domain.example any +noall +nocmd +ans +additional +authority +timeout=1
; (1 server found)
;; global options: +cmd

domain.example.          3600   IN      SOA     01.nameserver.example. hostmaster.nameserver.example. 1549943072 3600 900 604800 300
domain.example.          3600   IN      NS      01.nameserver.example.
domain.example.          3600   IN      NS      02.nameserver.example.
domain.example.          3600   IN      NS      03.nameserver.example.
domain.example.          3600   IN      NS      04.nameserver.example.
domain.example.          60     IN      A       127.0.0.1
domain.example.          60     IN      MX      10 mail.example.
domain.example.          60     IN      TXT     "v=spf1 include:_spf.domain.example. ~all"

EOF;
    }
}
