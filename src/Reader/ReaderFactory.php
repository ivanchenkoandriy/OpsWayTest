<?php
namespace OpsWay\Migration\Reader;

use OpsWay\Migration\Factory\ReaderWriterTrait;

/**
 * Class ReaderFactory
 *
 * @package OpsWay\Migration\Reader
 */
class ReaderFactory
{
    use ReaderWriterTrait;

    /**
     * @param       $className
     * @param array $params
     *
     * @return ReaderInterface
     */
    static public function create($className, array $params = [])
    {
        $instance = static::createInstance($className, $params);

        if (!($instance instanceof ReaderInterface)) {
            throw new \RuntimeException(sprintf('Reader "%s" should implement ReaderInterface', get_class($instance)));
        }

        return $instance;
    }
}
