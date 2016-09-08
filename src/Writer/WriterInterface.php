<?php

namespace OpsWay\Migration\Writer;

interface WriterInterface
{
    /**
     * @param $item array
     *
     * @return bool
     */
    public function write(array $item);
}
