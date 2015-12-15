<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Sentence
{
    /**
     * @var string[]
     */
    private $words;

    /**
     * @param string[] $words
     */
    public function __construct(array $words)
    {
        $this->words = $words;
    }

    /**
     * @return string[]
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->words);
    }
}
