<?php

namespace Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;
use MatthiasMullie\Minify\JS;

class JsMinifier implements PipeInterface
{
    /**
     * @inheritdoc
     */
    public function do(Source $src)
    {
        $output = null;

        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/js$/', $file->getRealPath)) {
                $min = new JS();
                $min->add($file->getContents());
                $output .= $min->minify();

                $src->removeDistFile($key);
            }
        }

        $src->addDistFile(new DistFile(md5(uniqid(microtime())) . '.js', $output));
    }
}
