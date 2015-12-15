<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ThematicMatcher
{
    /**
     * @var Thematic[]
     */
    private $thematics;

    public function __construct(array $thematics)
    {
        $this->thematics = $thematics;
    }

    /**
     * @param Sentence $sentence
     *
     * @return string[]
     */
    public function detect(Sentence $sentence)
    {
        $thematics = [];

        foreach ($sentence->getWords() as $word) {
            if ($thematic = $this->detectWord($word)) {
                $thematics[] = $thematic;
            }
        }

        return $thematics;
    }

    /**
     * @param string $word
     *
     * @return string|null
     */
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
