<?php

namespace Chanshige;

use Chanshige\Exception\DigExecutionException;
use Chanshige\Fake\Process;
use Traversable;

class DigTest extends CommonTestCase
{
    public function testFactory()
    {
        $this->assertInstanceOf(Dig::class, (new DigFactory())->newInstance());
    }

    public function testExecute()
    {
        $dig = new Dig(new Process());
        $result = $dig('domain.example', 'aaaa', '1.1.1.1');
        $expected = [
            '; <<>> DiG 9.11-Debian <<>> @8.8.8.8 domain.example any +noall +nocmd +ans +additional +authority +timeout=1',
            '; (1 server found)',
            ';; global options: +cmd',
            'domain.example.          3600   IN      SOA     01.nameserver.example. hostmaster.nameserver.example. 1549943072 3600 900 604800 300',
            'domain.example.          3600   IN      NS      01.nameserver.example.',
            'domain.example.          3600   IN      NS      02.nameserver.example.',
            'domain.example.          3600   IN      NS      03.nameserver.example.',
            'domain.example.          3600   IN      NS      04.nameserver.example.',
            'domain.example.          60     IN      A       127.0.0.1',
            'domain.example.          60     IN      MX      10 mail.example.',
            'domain.example.          60     IN      TXT     v=spf1 include:_spf.domain.example. ~all',
        ];

        $this->assertEquals(
            '/usr/bin/dig @1.1.1.1 domain.example aaaa +noall +nocmd +ans +additional +authority +timeout=1',
            (string)$dig
        );

        $this->assertInstanceOf(Traversable::class, $result);
        $this->assertEquals($expected, iterator_to_array($result));
    }

    public function testFailedSuccess()
    {
        $this->expectException(DigExecutionException::class);
        $this->expectExceptionMessage('exit code text.');

        $dig = new Dig(new Process(true));
        $dig('domain.example', 'aaaa', '1.1.1.1');
    }
}
