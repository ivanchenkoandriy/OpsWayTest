<?php

namespace OpsWay\Migration\Processor;

class YieldProcessor extends AbstractProcessor
{
    public function processing()
    {
        while ($item = $this->getReader()->read()) {
            call_user_func($this->logger, $item, true, '');
            yield $item;
        }
    }
}
