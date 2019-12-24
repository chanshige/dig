<?php

namespace Chanshige;

/**
 * Interface DigInterface
 */
interface DigInterface
{
    /**
     * Dig execute.
     *
     * @param string      $domain       [required] domain name
     * @param string|null $qType        [optional] query type
     * @param string|null $globalServer [optional] global server
     * @return array
     */
    public function __invoke(string $domain, ?string $qType = null, ?string $globalServer = null): array;
}
