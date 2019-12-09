[![Packagist](https://img.shields.io/badge/packagist-v1.0.0-blue.svg)](https://packagist.org/packages/chanshige/dig)
[![Build Status](https://travis-ci.org/chanshige/dig.svg?branch=master)](https://travis-ci.org/chanshige/dig)
[![Coverage Status](https://coveralls.io/repos/github/chanshige/dig/badge.svg?branch=master)](https://coveralls.io/github/chanshige/dig?branch=master)

# chanshige/dig
DNSレコード情報を調べることができます (intl extension is required.)

## Installation
With Composer
```
$ composer require chanshige/dig 'v1.0'
```

## usage
```php
<?php
use Chanshige\Dig;

$dig = new Dig();
$result = $dig('shigeki.tokyo', 'any', '8.8.8.8');

var_dump($result);
```

## test
`$ composer test`  


## coverage
![coverage]()

## License
MIT

## Author
[chanshige](https://twitter.com/chanshige)
