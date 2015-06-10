<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ArgumentMatcher
{
    public function getArguments(array $patterns, Sentence $sentence)
    {
        $arguments = array();
        $words = (string)$sentence;

        foreach ($patterns as $pattern) {
            $arguments = array_merge($arguments, $pattern->getMatchedArguments($words));
        }

        return $arguments;
    }
}
