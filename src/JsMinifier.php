<?php

namespace Phulp\Minifier;

use MatthiasMullie\Minify\JS;

class JsMinifier extends MinifierAbstract 
{
    /**
     * {@inheritdoc}
     */
    protected $options = [
        'join' => false,
        'joinName' => 'script.min.js'
    ];

    /**
     * {@inheritdoc}
     */
    protected function createMinifier()
    {
        return new JS;
    }
}
