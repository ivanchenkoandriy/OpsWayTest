<?php

namespace OpsWay\Migration\Reader\File;

use OpsWay\Migration\Reader\ReaderInterface;

class Csv implements ReaderInterface
{

    protected $file;
    protected $filename;
    protected $headers;

    public function __construct($params)
    {
        if (isset($params['filename'])) {
            $this->filename = $params['filename'];
        } else {
            throw new \InvalidArgumentException('Please set filename for csv in config file');
        }
    }

    /**
     * @return array|null
     */
    public function read()
    {
        if (!$this->file) {
            if (!($this->file = fopen($this->filename, 'r'))) {
                throw new \RuntimeException(sprintf('Can not open file "%s" for reading data.', $this->filename));
            }
            $this->headers = fgetcsv($this->file, 8192);
        }
        $data = fgetcsv($this->file, 8192);
        if ($data) {
            return array_combine($this->headers, $data);
        } else {
            return $data;
        }
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }

}
