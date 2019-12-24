<?php

namespace Chanshige\Foundation;

/**
 * Interface ProcessInterface
 *
 * @package Chanshige\Foundation
 */
interface ProcessInterface
{
    /** @var int Process is not terminated */
    public const NOT_TERMINATED_CODE = 9999;

    /**
     * Creates a Process instance as a command-line to be run in a shell wrapper.
     *
     * @param array $command The command to run and its arguments listed as separate entries
     * @return ProcessInterface
     */
    public function command(array $command): ProcessInterface;

    /**
     * Runs the process.
     *
     * @return int The exit status code
     */
    public function run(): int;

    /**
     * Checks if the process ended successfully.
     *
     * @return bool true if the process ended successfully, false otherwise
     */
    public function isSuccessful(): bool;

    /**
     * Returns a string representation for the exit code returned by the process.
     *
     * @return string A string representation for the exit status code
     */
    public function getExitCodeText(): string;

    /**
     * Returns the exit code returned by the process.
     *
     * @return int The exit status code
     */
    public function getExitCode(): int;

    /**
     * Returns the current output of the process (STDOUT).
     *
     * @return string The process output
     */
    public function getOutput(): string;

    /**
     * Gets the command line to be executed.
     *
     * @return string The command to execute
     */
    public function getCommandLine(): string;
}
