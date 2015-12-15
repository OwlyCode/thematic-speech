<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Thematic
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $words;

    /**
     * @param string   $name
     * @param string[] $words
     */
    public function __construct($name, array $words)
    {
        $this->name  = $name;
        $this->words = $words;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $word
     *
     * @return boolean
     */
    public function matches($word)
    {
        return in_array($word, $this->words);
    }
}
