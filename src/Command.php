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

final class Command
{
    /** @var string dig path */
    private $path = '/usr/bin/dig';

    /** @var string request to dns server. [default:google public dns] */
    private $globalServer = '8.8.8.8';

    /** @var string is in the Domain Name System */
    private $domain;

    /** @var string is one of (a,any,mx,ns,soa,hinfo,axfr,txt,...)[default:any] */
    private $qType = 'any';

    /**
     * @return $this
     */
    public function globalServer(string $globalServer)
    {
        $this->globalServer = $globalServer;

        return $this;
    }

    /**
     * @return $this
     */
    public function domain(string $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return $this
     */
    public function qType(string $qType)
    {
        $this->qType = $qType;

        return $this;
    }

    /**
     * @return $this
     */
    public function path(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Return a build dig command.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->path,
            '@' . $this->globalServer,
            $this->domain,
            $this->qType,
            '+noall',
            '+nocmd',
            '+ans',
            '+additional',
            '+authority',
            '+timeout=1'
        ];
    }

    /**
     * Return a build command.
     *
     * @return string
     */
    public function __toString(): string
    {
        return var_export($this->toArray(), true);
    }
}
