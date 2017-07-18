# TYPO3 TCO
[![Build Status](https://travis-ci.org/TildBJ/typo3-tco.svg?branch=master)](https://travis-ci.org/TildBJ/typo3-tco)
[![codecov](https://codecov.io/gh/TildBJ/typo3-tco/branch/master/graph/badge.svg)](https://codecov.io/gh/TildBJ/typo3-tco)

Helpful library for creating TCA's in TYPO3

## Installation

### via composer

The recommended way to install tco is by using composer.
Get tco by running
```sh
composer require tildbj/typo3-tco dev-master
```

### via Extensionmanager:

Just install tco via extensionmanager. There are no more steps required.

## Guide

### Create column:

```php
$tcaColumn = [
    'columnName' => (new \TildBJ\Tco\Input('LLL:ext:my_ext/Resources/Private/Language/locallang_db.xlf:columnName'))
        ->setRequired(false)
        ->toArray(),
    'columnName2' => (new \TildBJ\Tco\Image('LLL:ext:my_ext/Resources/Private/Language/locallang_db.xlf:columnName2', 'columnName2'))
        ->enableLink()
        ->setMaxItems(1)
        ->toArray(),
]
```

## Need Support?

Feel free to ask your questions on [Slack](https://typo3.slack.com/messages/C62CW8EJ0)