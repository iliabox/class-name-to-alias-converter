<?php

namespace Ilbox\Utils\FqcnConverter;

class SimpleFqcnConverter implements FqcnConverterInterface
{
    const C_INTERFACE = 'Interface';

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $suffix;

    /**
     * @param string $interface
     * @throws \LogicException
     */
    public function __construct(string $interface)
    {
        if (!preg_match("/^(.+?)([a-zA-Z0-9]+)".self::C_INTERFACE."$/", $interface, $res)) {
            throw new \LogicException("Wrong name of interface " . $interface);
        }

        $this->namespace = $res[1];
        $this->suffix    = $res[2];
    }

    /**
     * @param string $className
     * @return string
     * @throws \LogicException
     */
    public function fqcnToAlias(string $className): string
    {
//        if (!is_subclass_of($className, $this->getInterfaceName())) {
//            throw new \LogicException($className . " must implement " . $this->getInterfaceName());
//        }

        if (!preg_match("/([a-zA-Z0-9]+)".$this->suffix."$/", $className, $res)) {
            throw new \LogicException("Wrong name of class " . $className);
        }

        $classAlias = $res[1];

        return $classAlias;
    }

    /**
     * @param string $classAlias
     * @return string
     * @throws \LogicException
     */
    public function aliasToFqcn(string $classAlias): string
    {
        $className = $this->namespace . $classAlias . $this->suffix;

//        if (!is_subclass_of($className, $this->getInterfaceName())) {
//            throw new \LogicException($className . " must implement " . $this->getInterfaceName());
//        }

        return $className;
    }

    /**
     * @return string
     */
    private function getInterfaceName(): string
    {
        return $this->namespace . $this->suffix . self::C_INTERFACE;
    }

}
