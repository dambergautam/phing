<?php 
include_once 'vendor/autoload.php';

$cli->addCommands(array(
    // ...

    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Build</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<div id="container">

    <div class="box">
        <label class="title">To do list</label>
        <div>This is simple to do list application.</div>
    </div>

    <br />
    <div class="box">
        <label class="title">Other title</label>
        <div> More description goes here.</div>
        <div>
          <h3>Objectives</h3>
          <ol>
            <li>Fellowship- Create directory</li>
            <li>Move directory</li>
            <li>Create file</li>
            <li>Fellowship- Edit git ignore file content</li>
            <li>Fellowship- mysql queries -create table/ remove table/ add row/ edit row/ delete row</li>
          </ol>
        </div>
    </div>

</div>



    <!-- Script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script1.js"></script>
    <script src="js/script2.js"></script>

</body>
</html>
