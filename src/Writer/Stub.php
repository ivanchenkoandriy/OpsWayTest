<?php

namespace OpsWay\Migration\Writer;

class Stub implements WriterInterface
{
    /**
     * @param $item array
     *
     * @return bool
     */
    public function write(array $item)
    {
        // do something
        return true;
    }
}
