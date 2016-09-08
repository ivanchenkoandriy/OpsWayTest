<?php

namespace OpsWay\Migration\Writer\File;

use OpsWay\Migration\Writer\WriterInterface;

class Csv implements WriterInterface
{
    protected $file;
    protected $filename;

    public function __construct()
    {
        $this->checkFileName();
    }

    /**
     * @param $item array
     *
     * @return bool
     */
    public function write(array $item)
    {
        if (!$this->file) {
            if (!($this->file = fopen($this->filename, 'w+'))) {
                throw new \RuntimeException(sprintf('Can not create file "%s" for writing data.', $this->filename));
            }
            fputcsv($this->file, array_keys($item));
        }
        return fputcsv($this->file, $item);
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }

    private function checkFileName()
    {
        if (file_exists($this->filename)) {
            throw new \RuntimeException(sprintf('File "%s" already exists. Remove it and run again.', $this->filename));
        }
    }
}
