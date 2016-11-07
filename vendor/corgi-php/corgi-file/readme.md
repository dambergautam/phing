# Wat.

Corgi File is an easy-to-use file and directory manager package for `PHP 5.3` and greater. Its aim is to allow users to create, change, copy, move/rename and delete files and directories in a clean, object-oriented fashion.

# Installation

Install via `composer`:
```
{
  "require": {
    "corgi-php/corgi-file": "0.2.2"
  }
}
```

or by cloning/downloading the contents of this repo.

# Usage examples (not exhaustive)

## Working with files:

```php
use Corgi\File\File;

...

$file = new File('absolute/or/relative/path/to/file.txt');

// Create file
$file->touch();

// Rename/move file
$file->rename('new/path/to/file.txt.bak');

// Add text to file
$file->contents()->write('<?php return array("test" => "test");');

// Read file contents as text
$contents1 = $file->contents()->toString();
$contents2 = (string)$file->contents();

// Load file contents (assume valid PHP code; $data will contain an array at this point)
$data = $file->contents()->load();

// Delete file
$file->delete();
```


## Working with directories:

```php
use Corgi\File\Directory;

...

$directory = new Directory('absolute/or/relative/path/to/directory');

// Create directory
$directory->create();

// Rename/move directory
$file->rename('new/path/to/new/directory/location');

// Get directory contents
$commaSeparatedListOfContents = $directory->contents()->toString(', ');
$arrayOfContents = $directory->contents()->toArray();

// Delete directory
$directory->delete();

// Safe delete directory (only deletes dir if it's empty)
$directory->safeDelete();
```
