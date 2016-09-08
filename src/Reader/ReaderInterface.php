<?php

namespace OpsWay\Migration\Reader;

interface ReaderInterface
{
    /**
     * @return array|null
     */
    public function read();
}
