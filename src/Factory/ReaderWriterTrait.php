<?php

namespace OpsWay\Migration\Factory;

/**
 * Trait ReaderWriterTrait
 *
 * @package OpsWay\Migration\Factory
 */
trait ReaderWriterTrait
{
    /**
     * @param $className
     * @param $params
     *
     * @return mixed
     */
    static public function createInstance($className, $params)
    {
        $namespaceName = (new \ReflectionClass(static::class))->getNamespaceName();

        if (!class_exists($fullClassName = $namespaceName . '\\' . $className)) {
            if (class_exists($className)) {
                $fullClassName = $className;
            } else {
                throw new \RuntimeException(sprintf('Class "%s" in namespace "%s" is not found.' . PHP_EOL, $className, $namespaceName));
            }
        }

        return new $fullClassName($params);
    }
}
