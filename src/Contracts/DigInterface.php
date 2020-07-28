<?php
/*
 * This file is part of the Chanshige\Dig package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chanshige\Contracts;

use Traversable;

interface DigInterface
{
    public function __invoke(string $domain, ?string $qType = null, ?string $globalServer = null): Traversable;

    public function __toString(): string;
}
