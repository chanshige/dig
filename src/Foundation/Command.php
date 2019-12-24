<?php
declare(strict_types=1);

namespace Chanshige\Foundation;

/**
 * Class Command
 *
 * @package Chanshige\Foundation
 */
final class Command
{
    /** @var string dig path */
    private const PATH = '/usr/bin/dig';

    /** @var string request to dns server. [default:google public dns] */
    private $globalServer = '8.8.8.8';

    /** @var string is in the Domain Name System */
    private $domain = '';

    /** @var string is one of (a,any,mx,ns,soa,hinfo,axfr,txt,...)[default:any] */
    private $qType = 'any';

    /**
     * @param string $globalServer
     * @return $this
     */
    public function globalServer(string $globalServer)
    {
        $this->globalServer = $globalServer;

        return $this;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function domain(string $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @param string $qType
     * @return $this
     */
    public function qType(string $qType)
    {
        $this->qType = $qType;

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
            self::PATH,
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
