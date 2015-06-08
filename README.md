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

## Example usage

```php
use OwlyCode\ThematicSpeech\ThematicSpeech;

require __DIR__ . '/vendor/autoload.php';

$speech = new ThematicSpeech();

$speech->registerThematics([
    'light' => ['light', 'lightbulb'],
    'on'    => ['on', 'power', 'start'],
    'off'   => ['off', 'cut', 'shutdown'],
]);

$speech->register(['light', 'on'], function () {
    echo "Light turned on.\n";
});
$speech->register(['light', 'off'], function () {
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
