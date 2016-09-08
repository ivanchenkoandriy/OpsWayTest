<?php

namespace OpsWay\Migration\Logger;

use OpsWay\Migration\Writer\WriterFactory;

class OutOfStockLogger
{

    static public $countItem = 0;
    protected $debug;

    /**
     *
     * @var OpsWay\Migration\Writer\WriterInterface 
     */
    protected $writer;

    /**
     * @param boolean $mode Debug mode
     * @param array $params Config params
     */
    public function __construct($mode = false, $params)
    {
        $this->debug = $mode;
        if (isset($params['out_of_stock_file'])) {
            $filename = $params['out_of_stock_file'];
        } else {
            throw new \InvalidArgumentException('Config params must have out_of_stock_file');
        }
        $this->writer = WriterFactory::create('File\Csv', compact('filename'));
    }

    public function __invoke($item, $status, $msg)
    {

        if (!$this->validateItem($item)) {
            throw new \InvalidArgumentException('Item is not valid. Must have qty and is_stock');
        }
        if ($item['qty'] == 0 && $item['is_stock'] == 0) {
            try {
                $wrote = $this->writer->write($item);
                if (!$wrote) {
                    echo "Warning: cant write " . print_r($item, true) . ' to file ' . PHP_EOL;
                }
                $msg = '';
            } catch (\Exception $e) {
                $status = false;
                $msg = $e->getMessage();
            }
        }
        if (!$status) {
            echo "Warning: " . $msg . print_r($item, true) . PHP_EOL;
        }
    }

    public function validateItem($item)
    {
        return isset($item['qty']) && isset($item['is_stock']);
    }

}
