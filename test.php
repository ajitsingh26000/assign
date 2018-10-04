<?php
include 'connection.php';
echo "<pre>";

$name = 'ajit3';
$passw = '123456789a';

$userid = $connection->prepare('Select * from Users where username = ? AND pass = ?');
$userid->setFetchMode(PDO::FETCH_NUM);
$userid->execute(array($name, $passw));
//         $userid->debugDumpParams();
//         echo '<br><br>data ' ;
$row = $userid->fetchall();
//         echo "<br><br><br><br> row: ";
print_r($row);
// 


// $u = 'ajit3';
// $p = '123456789a';
// $a = array($u, $p);

// $sth = $connection->prepare('SELECT *
//     FROM Users
//     where username = ? AND pass = ?');
// $sth->execute($a);
// $sth->debugDumpParams();
// $red = $sth->fetchAll();

// print_r($red);
