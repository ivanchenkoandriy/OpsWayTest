<?php

use OpsWay\Migration\Logger\ConsoleLogger;
use OpsWay\Migration\Processor\ReadWriteProcessor;
use OpsWay\Migration\Reader\ReaderFactory;
use OpsWay\Migration\Writer\WriterFactory;

$config = include 'config.php';

if (defined('CLI_MODE') && CLI_MODE === false) {
    die('This can be run only on CLI mode.' . PHP_EOL);
}
echo "Start Time: " . date("d-m-Y H:i:s") . PHP_EOL;

try {
    $processor = new ReadWriteProcessor(
        ReaderFactory::create($config['reader'], $config['params']),
        WriterFactory::create($config['writer'], $config['params']),
        function($item, $status, $msg){
            static $countItem;
            if(is_null($countItem)){
                $countItem = 0;
            }
            if ((++$countItem % 2) == 0) {
                echo $countItem . " ";
            }
            if (!$status) {
                echo "Warning: " . $msg . print_r($item, true) . PHP_EOL;
            }
        }
    );
    //Processing
    $processor->processing();

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
} finally {
    echo PHP_EOL;
}

echo "End Time: " . date("d-m-Y H:i:s") . PHP_EOL;
