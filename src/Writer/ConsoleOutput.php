<?php

namespace OpsWay\Migration\Writer;

class ConsoleOutput implements WriterInterface
{
    protected $showHeader = false;
    /**
     * @param $item array
     *
     * @return bool
     */
    public function write(array $item)
    {
        if (!$this->showHeader) {
            echo implode(", ", array_keys($item)) . PHP_EOL;
            $this->showHeader = true;
        }
        echo implode(", ", array_values($item)) . PHP_EOL;
        return true;
    }
}
