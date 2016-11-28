<?php
$con=mysqli_connect("localhost","root","","masakan");
if (mysqli_connect_errno($con))
{
   echo '{"query_result":"ERROR"}';
}

$user = $_GET['user'];
$provinsi = $_GET['provinsi'];
$kota = $_GET['kota'];
$email = $_GET['email'];
$password = $_GET['password'];

$result = mysqli_query($con,"INSERT INTO user (user,provinsi,kota,email, password) 
          VALUES ('$user', '$provinsi', '$email', '$password')");

if($result == true) {
	echo '{"query_result":"SUCCESS"}';
}
else{
	echo '{"query_result":"FAILURE"}';
}
mysqli_close($con);
?>