<?php

namespace Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;
use MatthiasMullie\Minify\JS;

class JsMinifier implements PipeInterface
{
    /**
     * @var boolean $join
     */
    private $join;

    /**
     * @param boolean $join
     */
    public function __construct($join = false)
    {
        $this->join = $join;
    }

    /**
     * @inheritdoc
     */
    public function execute(Source $src)
    {
        $min = new JS();
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/js$/', $file->getName())) {
                if (!$this->join) {
                    $min = new CSS;
                }

                $min->add($file->getContent());

                if (!$this->join) {
                    $file->setContent($min->minify());
                } else {
                    $src->removeDistFile($key);
                }
            }
        }

        if ($this->join) {
            $src->addDistFile(new DistFile(md5(uniqid(microtime())) . '.js', $min->minify()));
        }
    }
}
