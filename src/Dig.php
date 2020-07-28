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

namespace Chanshige;

use Chanshige\Contracts\DigInterface;
use Chanshige\Exception\DigExecutionException;
use Chanshige\Handler\ProcessInterface;
use Traversable;

final class Dig implements DigInterface
{
    /** @var ProcessInterface */
    private $process;

    public function __construct(ProcessInterface $process)
    {
        $this->process = $process;
    }

    public function __invoke(string $domain, ?string $qType = null, ?string $globalServer = null): Traversable
    {
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
            throw new DigExecutionException($process->exitCodeText(), $process->exitCode());
        }

        return $this->convert($process->outputToArray());
    }

    private function convert(array $data): Traversable
    {
        foreach ($data as $value) {
            if (strlen($value) === 0) {
                continue;
            }
            $value = str_replace(["\t"], ' ', $value);
            $value = str_replace(['"'], '', $value);

            yield $value;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->process->commandLine();
    }
}
