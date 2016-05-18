<?php

namespace Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;
use MatthiasMullie\Minify\CSS;

class CssMinifier implements PipeInterface
{
    /**
     * @inheritdoc
     */
    public function do(Source $src)
    {
        $min = new CSS();
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/css$/', $file->getName())) {
                $min->add($file->getContent());

                $src->removeDistFile($key);
            }
        }

        $src->addDistFile(new DistFile(md5(uniqid(microtime())) . '.css', $min->minify()));
    }
}
