# phulp-minifier

The minifier addon for [PHULP](https://github.com/reisraff/phulp)

## Install

```bash
$ composer require reisraff/phulp-minifier
```

## Usage

```php
<?php

use Phulp\Minifier\CssMinifier;
use Phulp\Minifier\JsMinifier;

$phulp->task('css', function ($phulp) {
    $phulp->src(['src/'], '/css$/')
        // minify
        ->pipe(new CssMinifier)
        // write minified files
        ->pipe($phulp->dest('dist/'));
});

$phulp->task('js', function ($phulp) {
    $phulp->src(['src/'], '/js$/')
        // minify
        ->pipe(new JsMinifier)
        // write minified files
        ->pipe($phulp->dest('dist/'));
});

```

### Options

***Join*** : When join flag is true all distFiles will be merged in
one and the final file name will be a md5 hash. You can set this in
the constructor, by default the join flag is false:

```php
<?php

use Phulp\Minifier\CssMinifier;
use Phulp\Minifier\JsMinifier;

$cssMinifier = new CssMinifier(['join' => true]); // the join flag is true
$jsMinifier = new JsMinifier(['join' => true]); // the join flag is true

```
