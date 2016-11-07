<?php
//Load autoloader
include_once ('./vendor/autoload.php');

//For Directory function
//use Corgi\File\Directory

//Use file function
use Corgi\File\File;

//Load files content
//$file1 = new File('./README.md');
$file1 = new File('./build-hello-world.xml');

$build_hello_world = $file1->contents()->toString();
//$content = str_replace();

//print((string)$file1->contents());
//var_dump($build_hello_world);
//echo $build_hello_world;
//echo "</pre>";
//die();

$file2 = new File('./build-copy-file-dir.xml');
$build_copy_file_dir = $file2->contents()->toString();

$file3 = new File('./build-use_Depend_Archive_CreateDir.xml');
$build_use_Depend_Archive_CreateDir = $file3->contents()->toString();


?>
