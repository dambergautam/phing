<?php
require __DIR__.'/vendor/autoload.php';

require_once './migration/local-migrations-db.php';


use Doctrine\DBAL\DriverManager;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

//To avoid passing it all the time, I changed working script dir to the same dir
// as the configuration file so that doctrine migrations loads it automatically
chdir(__DIR__.'/migration');

$db = DriverManager::getConnection($params);

$helperSet = new HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
    'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper
));


$application = new Application();
$application->setHelperSet($helperSet);

// ... register commands
$application->addCommands(array(

    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand()
));


$application->run();
