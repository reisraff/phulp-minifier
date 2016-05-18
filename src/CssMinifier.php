<?php

namespace Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;
use MatthiasMullie\Minify\CSS;

class CssMinifier implements PipeInterface
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
        $min = new CSS;
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/css$/', $file->getName())) {
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
            $src->addDistFile(new DistFile(md5(uniqid(microtime())) . '.css', $min->minify()));
        }
    }
}
