<?php

use OpsWay\Migration\Logger\ConsoleLogger;
use OpsWay\Migration\Processor\YieldProcessor;
use OpsWay\Migration\Reader\ReaderFactory;
use OpsWay\Migration\Writer\WriterFactory;

$config = include 'config.php';

try {
    $processor = new YieldProcessor(
        ReaderFactory::create($config['reader'], $config['params']),
        WriterFactory::create($config['writer'], $config['params']),
        new ConsoleLogger(true)
    );
    // Processing
    foreach ($processor->processing() as $item) {
        $processor->getWriter()->write($item);
    }

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
} finally {
    echo PHP_EOL;
}