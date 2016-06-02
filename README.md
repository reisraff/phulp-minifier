# phulp-minifier

The minifier addon for [PHULP](https://github.com/reisraff/phulp)

## Install

```bash
$ composer require reisraff/phulp-minifier:~0.0.1
```

## Usage

```php
<?php

use Phulp\Phulp;
use Minifier\CssMinifier;
use Minifier\JsMinifier;

class PhulpFile extends Phulp
{
    public function define()
    {
        Phulp::task('css', function () {
            Phulp::src(['src/'], '/css$/')
                ->pipe(new CssMinifier)
                ->pipe(Phulp::dest('dist'));
        });

        Phulp::task('js', function () {
            Phulp::src(['src/'], '/php$/')
                ->pipe(new JsMinifier)
                ->pipe(Phulp::dest('dist'));
        });
    }
}

```

### Options

***Join*** : When join flag is true all distFiles will be merged in
one and the final file name will be a md5 hash. You can set this in
the constructor, by default the join flag is false:

```php
<?php

use Minifier\CssMinifier;
use Minifier\JsMinifier;

$cssMinifier = new CssMinifier(true); // the join flag is true
$jsMinifier = new JsMinifier(true); // the join flag is true

```
