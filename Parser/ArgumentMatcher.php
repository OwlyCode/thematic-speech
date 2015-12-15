<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ArgumentMatcher
{
    /**
     * @param array    $patterns
     * @param Sentence $sentence
     *
     * @return ArgumentCollection
     */
    public function getArguments(array $patterns, Sentence $sentence)
    {
        $arguments = [];
        $words = (string)$sentence;
        $collection = new ArgumentCollection();

        foreach ($patterns as $pattern) {
            $collection->addMany($pattern->getMatchedArguments($words));
        }

        return $collection;
    }
}
