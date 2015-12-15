<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ArgumentCollection
{
    /**
     * @var Argument[]
     */
    private $arguments;

    /**
     * @var Argument[][]
     */
    private $maps;

    /**
     * @param Argument[] $arguments
     */
    public function __construct(array $arguments = [])
    {
        $this->arguments = $arguments;
        $this->maps      = [];
    }

    /**
     * @param Argument[] $arguments
     */
    public function addMany(array $arguments)
    {
        foreach ($arguments as $argument) {
            $this->add($argument);
        }
    }

    /**
     * @param Argument $argument
     *
     * @return ArgumentCollection
     */
    public function add(Argument $argument)
    {
        $this->arguments[]= $argument;

        if (!array_key_exists($argument->getType(), $this->maps)) {
            $this->maps[$argument->getType()] = [];
        }

        $this->maps[$argument->getType()][] = $argument;

        return $this;
    }

    /**
     * @param string  $type
     * @param integer $count
     *
     * @return boolean
     */
    public function hasOfType($type, $count = null)
    {
        return array_key_exists($type, $this->maps) && (($count === null) || count($this->maps[$type]) >= $count);
    }

    /**
     * @param string $type
     *
     * @return Argument[]
     */
    public function getOfType($type)
    {
        return $this->hasOfType($type) ? $this->maps[$type] : [];
    }
}
