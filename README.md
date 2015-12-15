# Thematic Speech

This is an experimental library that can be used to determine actions to issue from natural language.

## Installation

```
{
    "require": {
        "owlycode/thematic-speech": "dev-master"
    }
}
```

## Basic usage

```php
<?php
use OwlyCode\ThematicSpeech\ThematicSpeech;

require __DIR__ . '/vendor/autoload.php';

$speech = new ThematicSpeech();

$speech->registerThematics([
    'light' => ['light', 'lightbulb'],
    'on'    => ['on', 'power', 'start'],
    'off'   => ['off', 'cut', 'shutdown'],
]);

$speech->register(['light', 'on'], [], function () {
    echo "Light turned on.\n";
});
$speech->register(['light', 'off'], [], function () {
    echo "Light turned off.\n";
});

$speech->process('Switch on the light please');
$speech->process('Now, switch off the light');
$speech->process('Power the lightbulb');
$speech->process('Cut the light');
```

This should produce an output like this :

```
Light turned on.
Light turned off.
Light turned on.
Light turned off.
```

### Using arguments

You can gather some dynamic values from sentences by using argument patterns :

```php
<?php

use OwlyCode\ThematicSpeech\Parser\ArgumentCollection;
use OwlyCode\ThematicSpeech\Parser\ArgumentPattern;
use OwlyCode\ThematicSpeech\ThematicSpeech;

require __DIR__ . '/vendor/autoload.php';

$speech = new ThematicSpeech();

// Each integers found in sentences will be considered as identifiers.
$identifierPattern = new ArgumentPattern('identifier', '/(\d+)/');

$speech->registerThematics([
    'light' => ['light', 'lightbulb'],
    'on'    => ['on', 'power', 'start'],
    'off'   => ['off', 'cut', 'shutdown'],
]);

$speech->register(['light', 'on'], [$identifierPattern], function (ArgumentCollection $arguments) {
    if (!$arguments->hasOfType('identifier', 1)) { // Checks we've got at least one identifier.
        echo sprintf('You must provide at least one light identifier.');
    } else {
        $poweredLights = $arguments->getOfType('identifier');
        $text = implode(', ', array_map(function ($id) {
            return sprintf('"%s"', $id->getValue());
        }, $poweredLights));

        echo sprintf("Light(s) %s turned on.\n", $text);
    }
});

$speech->process('Switch on the light 1, 2 and 3 please');
$speech->process('Turn on the light');
```

This should produce an output like this :

```
Light(s) "1", "2", "3" turned on.
You must provide at least one light identifier.
```
