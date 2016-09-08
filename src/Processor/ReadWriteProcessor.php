<?php

namespace OpsWay\Migration\Processor;

/**
 * Class ReadWriteProcessor
 *
 * @package OpsWay\Migration\Processor
 */
class ReadWriteProcessor extends AbstractProcessor
{
    public function processing()
    {
        while ($item = $this->getReader()->read()) {
            try {
                $status = $this->getWriter()->write($item);
                $msg = '';
            } catch (\Exception $e) {
                $status = false;
                $msg = $e->getMessage();
            }
            call_user_func($this->getLogger(), $item, $status, $msg);
        }
    }
}
