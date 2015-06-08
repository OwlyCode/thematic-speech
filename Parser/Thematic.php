<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Thematic
{
    private $name;

    private $words;

    public function __construct($name, array $words)
    {
        $this->name  = $name;
        $this->words = $words;
    }

    public function getName()
    {
        return $this->name;
    }

    public function matches($word)
    {
        return in_array($word, $this->words);
    }
}
