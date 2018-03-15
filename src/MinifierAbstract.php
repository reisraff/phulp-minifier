<?php

namespace Phulp\Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;

abstract class MinifierAbstract implements PipeInterface
{
    /**
     * @var array $options
     */
    protected $options =  [];
    
    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @inheritdoc
     */
    public function execute(Source $src)
    {
        $join = $this->options['join'];
        $min = $this->createMinifier();

        foreach ($src->getDistFiles() as $key => $file) {
            $min->add($file->getContent());

            if ($join) {
                $src->removeDistFile($key);
            } else {
                $file->setContent($min->minify());
                $min = $this->createMinifier();
            }
        }

        if ($join) {
            $name = $this->options['joinName'];
            $src->addDistFile(new DistFile($min->minify(), $name));
        }
    }

    /**
     * Creates new minifier instance
     * 
     * @return mixed
     */
    protected abstract function createMinifier();
}
