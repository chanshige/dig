<?php
declare(strict_types=1);

namespace Chanshige;

use Chanshige\Foundation\Exception\ExecutionException;
use Chanshige\Foundation\Process;
use Chanshige\Foundation\ProcessInterface;
use Generator;

/**
 * Class Dig
 *
 * @package Chanshige
 */
final class Dig implements DigInterface
{
    /** @var string */
    private const GOOGLE_PUBLIC_DNS = '8.8.8.8';

    /** @var ProcessInterface */
    private $process;

    /**
     * Dig constructor.
     *
     * @param ProcessInterface $process
     */
    public function __construct(ProcessInterface $process = null)
    {
        $this->process = $process ?? new Process;
    }

    /**
     * @param string $domain
     * @param string $qType
     * @param string $globalServer
     * @return array
     */
    public function __invoke(string $domain, string $qType = 'any', string $globalServer = self::GOOGLE_PUBLIC_DNS): array
    {
        $dig = ($this->process)($this->buildCommand($domain, $qType, $globalServer));
        $dig->run();

        if (!$dig->isSuccessful()) {
            throw new ExecutionException($dig->getExitCodeText());
        }

        return iterator_to_array($this->convert($dig->getOutput()));
    }

    /**
     * @param string $domain
     * @param string $qType
     * @param string $globalServer
     * @return array
     */
    private function buildCommand(string $domain, string $qType, string $globalServer): array
    {
        return [
            '/usr/bin/dig',
            '@' . $globalServer,
            $domain,
            $qType,
            '+noall',
            '+nocmd',
            '+ans',
            '+additional',
            '+authority',
            '+time=1'
        ];
    }

    /**
     * @param string $data
     * @return Generator
     */
    private function convert(string $data): Generator
    {
        foreach ((array)explode("\n", trim($data)) as $key => $value) {
            // <<>> DiG..
            if ($key <= 2 || strlen($value) === 0) {
                continue;
            }

            yield trim(str_replace(["\t", '"'], ' ', $value));
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->process->getCommandLine();
    }
}
