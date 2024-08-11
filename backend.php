<?php
include("conn.php");
session_start();

if (isset($_POST['register'])) {
	$username=$_POST['username'];
	$email=$_POST['email'];
	$passwords=$_POST['password'];
    $password=password_hash($passwords, PASSWORD_DEFAULT);
	$query=mysqli_query($con,"insert into auth (username,email,password) VALUES ('$username','$email','$password')");

	if ($query==true) {
		echo'<script>window.location.href="auth.php";alert("You are successfully registered!");</script>';
	}else{
		echo"Something went wrong!"; 
	}
} else if (isset($_POST['login'])) {
	
    $_SESSION['login']=$_POST['login'];
   $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
$_SESSION['user']=$email;
    // Check if email and password fields are filled
    if (empty($email) || empty($password)) {
        echo 'Please fill in all fields.';
        exit;
    }

    // Prepare and execute the query
    $sql = "SELECT * FROM auth WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch user data
    $user = mysqli_fetch_assoc($result);
    
    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
         echo'<script>window.location.href="index.php"</script>';
        // Here you might start a session, redirect to another page, etc.
    } else {
       echo'<script>window.location.href="auth.php";alert("Login failed")</script>';
    }   
}else if (isset($_POST['addstud'])) {
    $fullname=$_POST['fullname'];
    $address=$_POST['address'];
    $course=$_POST['course'];
     $section=$_POST['section'];
      $gender=$_POST['gender'];

    $query=mysqli_query($con,"insert into records (fullname,address,course,section,gender) VALUES ('$fullname',' $address',' $course','$section','$gender')");
    if ($query==true){
       echo'<script>window.location.href="index.php";alert("New students is inserted!")</script>'; 
    
    }

}
else if (isset($_POST['update'])) {
    $id=$_POST['id'];
  $fullname=$_POST['fullname'];
    $address=$_POST['address'];
    $course=$_POST['course'];
     $section=$_POST['section'];
      $gender=$_POST['gender'];

      $query=mysqli_query($con,"Update records set fullname='$fullname',address='$address',course='$course',section='$section',gender='$gender' where id = '$id'"); 
      if ($query==true){
        echo'<script>window.location.href="index.php";alert("Records updated successfully!")</script>'; 
      }
}else if(isset($_POST['delete'])){

    $id=$_POST['id'];

    $query=mysqli_query($con,"delete from records where id='$id'");
    if ($query==true) {
        echo'<script>window.location.href="index.php";alert("Records deleted successfully!")</script>'; 
    }
}


	
?>