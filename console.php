<?php
// application.php

require __DIR__.'\vendor\autoload.php';

//require __DIR__.'\migration\migrations.yml';
require __DIR__.'\migration\migrations-db.php';

$db = \Doctrine\DBAL\DriverManager::getConnection($params);



use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->addCommands(array(
    // ...

    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));


$application->run();