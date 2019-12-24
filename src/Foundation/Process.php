<?php

declare(strict_types=1);

namespace Chanshige\Foundation;

use Chanshige\Foundation\Exception\ExecutionException;
use Symfony\Component\Process\Exception\ExceptionInterface;
use Symfony\Component\Process\Process as SymfonyProcess;

/**
 * Class Process
 *
 * @package Chanshige\Foundation
 */
class Process implements ProcessInterface
{
    /** @var SymfonyProcess */
    private $process;

    /**
     * {@inheritDoc}
     */
    public function command(array $command): ProcessInterface
    {
        $this->process = new SymfonyProcess($command);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function run(): int
    {
        return $this->process->run();
    }

    /**
     * {@inheritDoc}
     */
    public function isSuccessful(): bool
    {
        return $this->process->isSuccessful();
    }

    /**
     * {@inheritDoc}
     */
    public function getOutput(): string
    {
        try {
            return $this->process->getOutput();
        } catch (ExceptionInterface $e) {
            throw new ExecutionException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getExitCodeText(): string
    {
        return $this->process->getExitCodeText() ?? '';
    }

    /**
     * {@inheritDoc}
     */
    public function getExitCode(): int
    {
        return $this->process->getExitCode() ?? ProcessInterface::NOT_TERMINATED_CODE;
    }

    /**
     * {@inheritDoc}
     */
    public function getCommandLine(): string
    {
        return $this->process->getCommandLine();
    }
}
