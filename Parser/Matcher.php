<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Matcher
{
    private $thematics;

    public function __construct(array $thematics)
    {
        $this->thematics = $thematics;
    }

    public function detect(Sentence $sentence)
    {
        $thematics = array();

        foreach ($sentence->getWords() as $word) {
            if ($thematic = $this->detectWord($word)) {
                $thematics[] = $thematic;
            }
        }

        return $thematics;
    }

    private function detectWord($word)
    {
        foreach ($this->thematics as $thematic) {
            if ($thematic->matches($word)) {
                return $thematic->getName();
            }
        }

        return null;
    }
}
