<?php
/*
 * This file is part of the Chanshige\Dig package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Chanshige\Handler;

use Chanshige\Exception\DigExecutionException;
use Symfony\Component\Process\Exception\ExceptionInterface;
use Symfony\Component\Process\Process as SymfonyProcess;

class Process implements ProcessInterface
{
    /** @var SymfonyProcess */
    private $process;

    public function command(array $command): ProcessInterface
    {
        $this->process = new SymfonyProcess($command);

        return $this;
    }

    public function run(): int
    {
        return $this->process->run();
    }

    public function isSuccessful(): bool
    {
        return $this->process->isSuccessful();
    }

    public function output(): string
    {
        try {
            return $this->process->getOutput();
        } catch (ExceptionInterface $e) {
            throw new DigExecutionException($e->getMessage(), $e->getCode());
        }
    }

    public function outputToArray(string $delimiter = "\n"): array
    {
        return explode($delimiter, $this->output());
    }

    public function exitCodeText(): string
    {
        return $this->process->getExitCodeText() ?? '';
    }

    public function exitCode(): ?int
    {
        return $this->process->getExitCode();
    }

    public function commandLine(): string
    {
        return $this->process->getCommandLine();
    }
}
