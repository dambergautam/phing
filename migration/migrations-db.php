<?php

return array(
    'dbname' => 'tst_damber',
    'user' => 'root',
    'password' => 'damber123',
    'host' => 'localhost',
    'driver' => 'mysqli'
);
//Swithing database connections params
/*
$mode = 1;

if($mode ==1){
  return array(
      'dbname' => 'tst_damber',
      'user' => 'root',
      'password' => 'damber123',
      'host' => 'localhost',
      'driver' => 'mysqli'
  );

}else if($mode == 2){
  return array(
      'dbname' => 'saman_rock',
      'user' => 'root',
      'password' => '',
      'host' => 'localhost',
      'driver' => 'mysqli'
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
*/
?>
