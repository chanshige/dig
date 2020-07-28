[![Packagist](https://img.shields.io/badge/packagist-v1.0.0-blue.svg)](https://packagist.org/packages/chanshige/dig)
[![Build Status](https://travis-ci.org/chanshige/dig.svg?branch=master)](https://travis-ci.org/chanshige/dig)
[![Coverage Status](https://coveralls.io/repos/github/chanshige/dig/badge.svg?branch=master)](https://coveralls.io/github/chanshige/dig?branch=master)

# chanshige/dig
DNSレコード情報を調べることができます  
※BINDのdnsutil(dig command)がインストールされている環境で実行できます。

## Installation
With Composer
```
$ composer require chanshige/dig 'v2.0'
```

## usage
```php
<?php
use Chanshige\DigFactory;

$dig = (new DigFactory())->newInstance();

# Traversable
$result = $dig('shigeki.tokyo', 'any', '8.8.8.8');

# toArray
var_dump(iterator_to_array($result));

# show command line
echo $dig;
```

## test
`$ composer test`  


## coverage
![coverage](https://i.gyazo.com/1b6a7d56dbc7f62ed6e2fc2055c18582.png)

## License
MIT

## Author
[chanshige](https://twitter.com/chanshige)
