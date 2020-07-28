<?php
/*
 * This file is part of the Chanshige\Dig package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Chanshige\Handler;

interface ProcessInterface
{
    /**
     * Creates a Process instance as a command-line to be run in a shell wrapper.
     *
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
    public function exitCodeText(): string;

    /**
     * Returns the exit code returned by the process.
     *
     * @return int|null The exit status code
     */
    public function exitCode(): ?int;

    /**
     * Returns the current output of the process (STDOUT).
     *
     * @return string The process output
     */
    public function output(): string;

    /**
     * Returns the current output array of the process (STDOUT).
     *
     * @return array The process output
     */
    public function outputToArray(string $delimiter = "\n"): array;

    /**
     * Gets the command line to be executed.
     *
     * @return string The command to execute
     */
    public function commandLine(): string;
}
