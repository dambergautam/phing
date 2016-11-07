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

include_once './include/file_dir_function.inc.php';
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
    <div class="header"><span class="bigtext">PHING</span> <span class="smalltext">PHing Is Not GNU make; it's a PHP project build system or build tool.</span></div>
    <div class="box">
        <label class="title">Objectives</label>
        <div>
          <ol>
            <li>Fellowship- Create directory</li>
            <li>Move directory</li>
            <li>Create file</li>
            <li>Fellowship- Edit git ignore file content</li>
            <li>Fellowship- mysql queries -create table/ remove table/ add row/ edit row/ delete row</li>
          </ol>
        </div>
    </div>

    <div class="box">
      <label class="title">Build -Print 'Hello World!' </label>
      <span class="command">$ phing [or $phing welcome]</span>
      <div class="script">
        <?php echo "<pre>".(htmlentities($build_hello_world))."</pre>"; ?>
      </div>
    </div>

    <div class="box">
      <label class="title">Build -Copy file and directory </label>
      <span class="command">$ phing copyfile</span>
      <div class="script">
        <?php echo "<pre>".(htmlentities($build_copy_file_dir))."</pre>"; ?>
      </div>
    </div>

    <div class="box">
      <label class="title">Build -Use Depends, Archive and create Directory </label>
      <span class="command">$ phing archive</span>
      <div class="script">
        <?php echo "<pre>".(htmlentities($build_use_Depend_Archive_CreateDir))."</pre>"; ?>
      </div>
    </div>
</div>



    <!-- Script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script1.js"></script>
    <script src="js/script2.js"></script>

</body>
</html>
