<?php

session_start();

try{

$dbh=new PDO('mysql:host=localhost;dbname=signup;charset=utf8','root','');

$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$friend=$_REQUEST["username"];

$user=$_SESSION["username"];

$a=explode(" ",$friend);

$stmt=$dbh->query("SELECT friendrequest FROM students WHERE name LIKE '$a[0]%' ");

$result=$stmt->fetch();

if($result[0]!=null)

$user=$result[0].",".$user;

$q="UPDATE students SET friendrequest='$user' WHERE name LIKE '$a[0]%' ";

$dbh->exec($q);

}

catch(PDOException $e)

{

echo "Connection failed:".$e->getMessage();

}

?>
