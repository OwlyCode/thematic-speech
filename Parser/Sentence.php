<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Sentence
{
    private $words;

    public function __construct(array $words)
    {
        $this->words = $words;
    }

    public function getWords()
    {
        return $this->words;
    }
}
