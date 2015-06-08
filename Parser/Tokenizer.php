<?php

namespace OwlyCode\ThematicSpeech\Parser;

class Tokenizer
{
    public function buildSentence($string)
    {
        $string = strtolower($this->unaccent($string));

        return new Sentence(explode(' ', $string));
    }

    private function unaccent($str)
    {
        return iconv('utf-8', 'ascii//TRANSLIT', $str);
    }
}
