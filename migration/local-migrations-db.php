<?php
//Swithing database connections params

$mode = 2;

if($mode ==1){
  $params = array(
      'dbname' => 'tst_damber',
      'user' => 'root',
      'password' => 'damber123',
      'host' => 'localhost',
      'driver' => 'mysqli',
      'charset' => 'UTF8',
      'enum' => 'string'
  );

}else if($mode == 2){
  $params = array(
      'dbname' => 'saman_rock',
      'user' => 'root',
      'password' => '',
      'host' => 'localhost',
      'driver' => 'mysqli',
      'charset' => 'UTF8',
      'enum' => 'string'
  );
}

//connections
$check_db = 0;
if($check_db == 1){
  $link = mysqli_connect($params['host'], $params['user'], $params['password'], $params['dbname']);
  if($link){
    echo "Connected";
  }
  else{
    echo "Not connected";
  }
  die();
}
?>