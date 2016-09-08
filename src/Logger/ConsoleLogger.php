<?php

namespace OpsWay\Migration\Logger;

class ConsoleLogger
{
    static public $countItem = 0;
    protected $debug;

    public function __construct($mode = false)
    {
        $this->debug = $mode;
    }

    public function __invoke($item, $status, $msg)
    {
        if ((++self::$countItem % 2) == 0 && $this->debug) {
            echo self::$countItem . " ";
        }
        if (!$status) {
            echo "Warning: " . $msg . print_r($item, true) . PHP_EOL;
        }
    }
}
