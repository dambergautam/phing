<?php
require __DIR__.'/vendor/autoload.php';

$params= array(
    'dbname' => 'tst_damber',
    'user' => 'root',
    'password' => 'damber123',
    'host' => 'localhost',
    'driver' => 'mysqli'
);


use Doctrine\DBAL\DriverManager;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

$db = DriverManager::getConnection($params);
$helperSet = new HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
    'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper
));


$application = new Application();
$application->setHelperSet($helperSet);

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
