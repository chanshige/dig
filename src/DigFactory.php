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
use Chanshige\Handler\Process;

class DigFactory
{
    public function newInstance(): DigInterface
    {
        return new Dig(new Process());
    }
}
