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

Set in the constructor.

***Join*** : When join flag is true all distFiles will be merged in one.

***joinName*** : Name of the joined file.

```php
<?php

use Phulp\Minifier\CssMinifier;
use Phulp\Minifier\JsMinifier;

$cssMinifier = new CssMinifier([
    // default: false
    'join' => true,
    // default: styles.min.css
    'joinName' => 'myMinifiedCss.css'
]);
$jsMinifier = new JsMinifier([
    // default: false
    'join' => true
    // default: script.min.js
    'joinName' => 'myMinifiedJs.js'
]);

```
