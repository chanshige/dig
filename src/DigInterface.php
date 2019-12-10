<?php

namespace Chanshige;

/**
 * Interface DigInterface
 */
interface DigInterface
{
    /**
     * @param string $domain
     * @param string $qType
     * @param string $globalServer
     * @return array
     */
    public function __invoke(string $domain, string $qType, string $globalServer): array;
}
