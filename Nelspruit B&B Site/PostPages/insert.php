<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone'];


if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || !empty($phoneCode) || !empty($phone)){
	
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";  
$dbname = "register";
//creating connection to my data base
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

if (mysqli_connect_error()){
	die('connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());  
}else {
$SELECT = "SELECT email from register Where email = ? Limit 1";

$INSERT = "INSERT Into register (username, password, gender, email, phoneCode, phone) values(?,?,?,?,?,?)";
//Prepare stattemnts
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s", $email);
	$stmt-> execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum = $stmt->num_rows;

	if ($rnum ==0){
	$stmt->close();
//The four ssss snd two ii means strings and integers
	$stmt = $conn->prepare($INSERT);
	$stmt->bind_param("ssssii", $username, $password, $gender, $email, $phoneCode, $phone);
	$stmt->execute();
	echo "Thank You, You have Succefully Created Your Account At Nelspruit B & B We Will Get To You Back Shortly, And Your Booking Will Be Placed Into Order Before Your Arrival, We Can't Wait To Be At Your Service";
	
}else {
	echo "The email you have entered is already being used in Nelspruit B & B";

}

$stmt -> close();
$conn -> close();

}
}else {
	echo "All field are required";
	die();
}

?>