<?php
namespace OpsWay\Migration\Processor;

use OpsWay\Migration\Reader\ReaderInterface;
use OpsWay\Migration\Writer\WriterInterface;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * @var ReaderInterface
     */
    protected $reader;
    /**
     * @var WriterInterface
     */
    protected $writer;
    /**
     * @var callable
     */
    protected $logger;

    /**
     * @param ReaderInterface $reader
     * @param WriterInterface $writer
     * @param callable        $logger
     */
    public function __construct(ReaderInterface $reader, WriterInterface $writer, $logger)
    {
        if (!is_callable($logger)) {
            throw new \InvalidArgumentException('Logger should be callable');
        }
        $this->setReader($reader);
        $this->setWriter($writer);
        $this->setLogger($logger);
    }

    abstract public function processing();

    /**
     * @param WriterInterface $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    /**
     * @param callable $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ReaderInterface $reader
     */
    public function setReader($reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return WriterInterface
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @return ReaderInterface
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @return callable
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
