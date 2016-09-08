<?php
date_default_timezone_set('UTC');

include 'vendor/autoload.php';

$config = [
    'params' => []
];

if (PHP_SAPI !== 'cli') {
    if ((!isset($_GET['reader'])) || (!isset($_GET['writer']))) {
        die ('Please input required params: web.php?reader=ClassReader&writer=ClassReader' . PHP_EOL);
    }

    $config['reader'] = $_GET['reader'];
    $config['writer'] = $_GET['writer'];
    @define("CLI_MODE", false);
} else {
    if ((!isset($argv[1])) || (!isset($argv[2]))) {
        die ('Please input required params: cli.php "ClassReader" "ClassWriter"' . PHP_EOL);
    }

    $config['reader'] = $argv[1];
    $config['writer'] = $argv[2];
    @define("CLI_MODE", true);
}

foreach (glob(__DIR__ . "/config/*.php") as $file) {
    $config['params'] = array_merge($config['params'], include $file);
}

return $config;
