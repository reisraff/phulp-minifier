<?php

namespace Phulp\Minifier;

use MatthiasMullie\Minify\CSS;

class CssMinifier extends MinifierAbstract 
{
    /**
     * {@inheritdoc}
     */
    protected $options = [
        'join' => false,
        'joinName' => 'styles.min.css'
    ];

    /**
     * {@inheritdoc}
     */
    protected function createMinifier()
    {
        return new CSS;
    }
}
