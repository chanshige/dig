<?php
declare(strict_types=1);

namespace Chanshige;

use Chanshige\Foundation\Command;
use Chanshige\Foundation\Exception\ExecutionException;
use Chanshige\Foundation\Process;
use Chanshige\Foundation\ProcessInterface;

/**
 * Class Dig
 *
 * @package Chanshige
 */
final class Dig implements DigInterface
{
    /** @var ProcessInterface */
    private $process;

    /**
     * Dig constructor.
     *
     * @param ProcessInterface $process
     */
    public function __construct(ProcessInterface $process = null)
    {
        $this->process = $process ?? new Process();
    }

    /**
     * @param string $domain
     * @param string $qType
     * @param string $globalServer
     * @return array
     */
    public function __invoke(
        string $domain,
        ?string $qType = null,
        ?string $globalServer = null
    ): array {
        $command = (new Command())->domain($domain);
        if (!is_null($qType)) {
            $command->qType($qType);
        }

        if (!is_null($globalServer)) {
            $command->globalServer($globalServer);
        }

        $process = $this->process->command($command->toArray());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ExecutionException($process->getExitCodeText());
        }

        return $this->convert(explode("\n", $process->getOutput()));
    }

    /**
     * @param array $data
     * @return array
     */
    private function convert(array $data): array
    {
        $row = [];
        foreach ($data as $value) {
            if (strlen($value) === 0) {
                continue;
            }
            $value = str_replace(["\t"], ' ', $value);
            $value = str_replace(['"'], '', $value);

            $row[] = $value;
        }

        return $row;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->process->getCommandLine();
    }
}
