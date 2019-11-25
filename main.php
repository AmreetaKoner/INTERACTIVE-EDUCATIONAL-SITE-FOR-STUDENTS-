<?php

session_start();

if($_SESSION['status']!="active"){

 
header("location:login.html");

}

$cookie_name="NewUser";

$cookie_value=$_SESSION['username'];

setcookie($cookie_name,$cookie_value,time()+(86400*5));

?>

<!DOCTYPE html>

<head>

<script

src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"
></script>

</head>

<html>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">

<link rel='stylesheet'
href='https://fonts.googleapis.com/css?family=Open+Sans'>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-

awesome/4.7.0/css/font-awesome.min.css">

<style>

#scroll,#findfriend{

overflow:auto;

}

 
html,body,h1,h2,h3,h4,h5

{font-family: "Open Sans", sans-serif}

</style>

<body class="w3-theme-l5" >

<!-- Navbar -->

<div class="w3-top">

<div class="w3-bar w3-theme-d2 w3-left-align w3-large">

<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>

<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Skwela</a>

<div class="w3-dropdown-hover w3-hide-small">

<button class="w3-button w3-padding-large" title="Friend Requests" id="fr"><i class="fa fa-globe"></i></button><div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">

<p id="friendrequests"></p>

</div>

</div>

<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings" onclick="modify()"><i class="fa fa-user"></i></a>

<script type="text/javascript">

function modify(){

location.href="modify.html";

}

</script>

 




<div class="w3-dropdown-hover w3-hide-small">

<button class="w3-button w3-padding-large" title="My Friends"><i class="fa fa-address-book"></i></button><div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px" id="scroll">

<p id="myfriends"></p>

</div>

</div>

<div class="w3-dropdown-hover w3-hide-small">

<button class="w3-button w3-padding-large" title="Find Friends"><i class="fa fa-handshake-o"></i></button><div class="w3-dropdown-content w3-card-4 w3-bar-block" id="findfriend" style="width:300px" >

</div>

</div>

<script type="text/javascript">



$(window).ready(function(){

var xmlhttp =new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){

if(xmlhttp.readyState==4 && xmlhttp.status==200){

var obj=JSON.parse(xmlhttp.responseText);

var i=0;

while(i<obj.length){

var att=document.createElement("p");

var node=document.createTextNode(obj[i]);

 
att.appendChild(node);

var element =document.getElementById("findfriend"); element.appendChild(att);
(function(index){

var btn=$('<button>Add Friend</button>').on("click",function(){

frequest(obj[index]);});

$('#findfriend').append(btn);})(i);

i++;

}

}

}

xmlhttp.open('GET','allusers.php',true);

xmlhttp.send();

});



</script>

<script type="text/javascript">

function frequest(a){

$.post("friendrequest.php",{username:a},function(){ alert("Friend Request Sent");
});

document.getElementById("findfriend").innerHTML=""; var xmlhttp =new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){ if(xmlhttp.readyState==4 && xmlhttp.status==200){ var obj=JSON.parse(xmlhttp.responseText);

 
var i=0;

while(i<obj.length){

var att=document.createElement("p");

var node=document.createTextNode(obj[i]); att.appendChild(node);

var element =document.getElementById("findfriend"); element.appendChild(att);
(function(index){

var btn=$('<button>Add Friend</button>').on("click",function(){

frequest(obj[index]);});

$('#findfriend').append(btn);})(i);

i++;

}

}

}

xmlhttp.open('GET','allusers.php',true); xmlhttp.send();
}

</script>



<div class="w3-dropdown-hover w3-hide-small">

<button class="w3-button w3-padding-large" title="Your courses"><i class="fa fa-book"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button><div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">

<a href="#" class="w3-bar-item w3-button" id="one" ></a>

<a href="#" class="w3-bar-item w3-button" id="two"></a>

 
<a href="#" class="w3-bar-item w3-button" id="three"></a>

</div>

</div>

<a class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Sign out" onclick="signout()">

<img src="images/user.png" class="w3-circle"

style="height:23px;width:23px" alt="User">

</a>

</div>

</div>

<script type="text/javascript">

var arr;

$(window).ready(function friendreq(){

var xmlhttp =new XMLHttpRequest();

xmlhttp.onreadystatechange=function (){

if(xmlhttp.readyState==4 && xmlhttp.status==200){

var obj=JSON.parse(xmlhttp.responseText);

arr=obj.split(",");

if(arr.length!=0){

var i=0;

while(i<arr.length && arr[0]!=""){

var att=document.createElement("p");

var node=document.createTextNode(arr[i]);

att.appendChild(node);

var element =document.getElementById("friendrequests");

element.appendChild(att);

(function(index){

 
var btn=$('<button>Accept</button>').on("click",function(){



friends(1,index,arr);

});

$('#friendrequests').append(btn);

var btn2=$('<button>Decline</button>').on("click",function(){ friends(0,index,arr);
});

$('#friendrequests').append(btn2);})(i); i++;
}

}

}

}

xmlhttp.open('GET','fr2.php',true);

xmlhttp.send();

});

</script>

<script type="text/javascript">

function friends(a,i,arr){

var p=arr[i];

$.post("friends.php",{req:a,name:p},function(){ if(a==0)

alert(arr[i]+"'s Friend Request Declined"); else

alert(arr[i]+"'s Friend Request Accepted");

 
});

document.getElementById("friendrequests").innerHTML=""; var xmlhttp =new XMLHttpRequest();
xmlhttp.onreadystatechange=function (){

if(xmlhttp.readyState==4 && xmlhttp.status==200){

var obj=JSON.parse(xmlhttp.responseText);

arr=obj.split(",");

if(arr.length!=0){

var i=0;

while(i<arr.length && arr[0]!=""){ var att=document.createElement("p");

var node=document.createTextNode(arr[i]); att.appendChild(node);

var element =document.getElementById("friendrequests");

element.appendChild(att);

(function(index){

var btn=$('<button>Accept</button>').on("click",function(){



friends(1,index,arr);

});

$('#friendrequests').append(btn);

var btn2=$('<button>Decline</button>').on("click",function(){ friends(0,index,arr);
});

$('#friendrequests').append(btn2);})(i); i++;

 
}

}

}

}

xmlhttp.open('GET','fr2.php',true);

xmlhttp.send();

document.getElementById("myfriends").innerHTML="";

var xhttp =new XMLHttpRequest();

xhttp.onreadystatechange=function(){ if(xhttp.readyState==4 && xhttp.status==200){ var ob=JSON.parse(xhttp.responseText); var ar=ob.split(",");

var i=0;

if(ar[0]!=""){

while(i<ar.length){

var att=document.createElement("p");

var node=document.createTextNode(ar[i]); att.appendChild(node);

var element =document.getElementById("myfriends"); element.appendChild(att);
(function(index){

var btn=$('<button>Chat</button>').on("click",function(){ $.post("setfriends.php",{name:ar[index]}); location.href="chatbox.html";
});

$('#myfriends').append(btn);})(i);

 
i++;

}

}

}

}

xhttp.open('GET','friendlist.php',true); xhttp.send();

document.getElementById("findfriend").innerHTML=""; var xlhttp =new XMLHttpRequest();

xlhttp.onreadystatechange=function(){ if(xlhttp.readyState==4 && xlhttp.status==200){ var obj=JSON.parse(xlhttp.responseText); var i=0;

while(i<obj.length){

var att=document.createElement("p");

var node=document.createTextNode(obj[i]); att.appendChild(node);

var element =document.getElementById("findfriend"); element.appendChild(att);
(function(index){

var btn=$('<button>Add Friend</button>').on("click",function(){

frequest(obj[index]);});

$('#findfriend').append(btn);})(i);

i++;

}

}

 
}

xlhttp.open('GET','allusers.php',true); xlhttp.send();

}



</script>



<!-- Navbar on small screens -->






<!-- Page Container -->

<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

<!-- The Grid -->

<div class="w3-row">

<!-- Left Column -->

<div class="w3-col m3">

<!-- Profile -->

<div class="w3-card w3-round w3-white"> <div class="w3-container">

<h4 class="w3-center">My Profile</h4>

<p class="w3-center"><img src="images/user.png" class="w3-circle" style="height:106px;width:106px" alt="User"></p>

<hr>

<p id="user"><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['username']; ?></p>

 
<p  id="add"><i class="fa fa-home fa-fw w3-margin-right w3-

text-theme"> </i> <?php echo
$_SESSION['city'].",".$_SESSION['country']; ?></p>



</div>

</div>

<br>

<script type="text/javascript">

$(window).ready(function(){

var xmlhttp =new XMLHttpRequest(); xmlhttp.onreadystatechange=function(){

if(xmlhttp.readyState==4 && xmlhttp.status==200){ var obj=JSON.parse(xmlhttp.responseText); var arr=obj.split(",");
var i=0;

if(arr[0]!=""){

while(i<arr.length){

var att=document.createElement("p");

var node=document.createTextNode(arr[i]); att.appendChild(node);

var element =document.getElementById("myfriends"); element.appendChild(att);
(function(index){

var btn=$('<button>Chat</button>').on("click",function(){ $.post("setfriends.php",{name:arr[index]}); location.href="chatbox.html";
});

 
$('#myfriends').append(btn);})(i);

i++;

}

}

}

}

xmlhttp.open('GET','friendlist.php',true); xmlhttp.send();


});

</script>



</div>

<div class="w3-col m7">

<div class="w3-row-padding">

<div class="w3-col m12">

<div class="w3-card w3-round w3-white"> <div class="w3- container w3-padding"> <h3 >Search For new Courses</h3>

<h3 id="rough"></h3>

<p contenteditable="true" class="w3-border w3-padding"></p>

<button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>Search</button>

</div>

</div>

</div>

 
</div>

<!-- Footer -->

<footer class="w3-container w3-theme-d3 w3-padding-16">

<h5> Continue learning with Skwela</h5>

</footer>

<?php

echo '<script language="javascript">'. 'alert("We use cookies to ensure that we give you the best experience on our website. ")'. '</script>';?>

<script>

function signout()

{

location.href='signout.php';

}

</script>

</body>

</html>
