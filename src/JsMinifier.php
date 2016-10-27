<?php

namespace Phulp\Minifier;

use Phulp\PipeInterface;
use Phulp\Source;
use Phulp\DistFile;
use MatthiasMullie\Minify\JS;

class JsMinifier implements PipeInterface
{
    /**
     * @var array $options
     */
    private $options = [
        'join' => false,
    ];

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
        $min = new JS();
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/js$/', $file->getName()) || preg_match('/js$/', $file->getDistpathname())) {
                if (!$this->options['join']) {
                    $min = new JS;
                }

                $min->add($file->getContent());

                if (!$this->options['join']) {
                    $file->setContent($min->minify());
                } else {
                    $src->removeDistFile($key);
                }
            }
        }

        if ($this->options['join']) {
            $src->addDistFile($min->minify(), new DistFile(md5(uniqid(microtime())) . '.js'));
        }
    }
}
