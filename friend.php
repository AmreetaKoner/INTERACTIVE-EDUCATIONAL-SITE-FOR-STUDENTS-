<?php

session_start();

try{

$dbh=new

PDO('mysql:host=localhost;dbname=signup;charset=utf8','root','');

$dbh-

>setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPT ION);

$friend=$_REQUEST["name"];

$r=$_REQUEST["req"];

$user=$_SESSION["username"];

 
$id=$_SESSION["id"];

$ar=explode(" ",$user);

$ar2=explode(" ",$friend);

$stmt=$dbh->query("SELECT friendrequest FROM students WHERE name LIKE '$ar[0]%' ");

$result=$stmt->fetch();

$a=explode(",",$result[0]);

for($i=0;$i<sizeof($a);$i++){

if($a[$i]==$friend){

unset($a[$i]);

$final=join(",",$a);

}

}

$q="UPDATE students SET friendrequest='$final' WHERE name LIKE '$ar[0]%'";

$dbh->exec($q);

if($r==1){

$u=$user;

$stmt=$dbh->query("SELECT friends FROM students WHERE name LIKE '$ar[0]%' ");

$results=$stmt->fetch();

if($results[0]!=null)

$friend=$results[0].",".$friend;

$q="UPDATE students SET friends='$friend' WHERE name LIKE '$ar[0]%' ";

$dbh->exec($q);

$st=$dbh->query("SELECT friends FROM students WHERE name LIKE '$ar2[0]%' ");

 
$newresult=$st->fetch();

if($newresult[0]!=null)

$u=$newresult[0].",".$u;

$q="UPDATE students SET friends='$u' WHERE name LIKE '$ar2[0]%' ";

$dbh->exec($q);

}

}

catch(PDOException $e)

{

echo "Connection failed:".$e->getMessage();

}

?>

