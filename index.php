<?php

session_start();
$error=3;
if(isset($_POST['submit']))
{
    require 'connect.php';
    $type= $_POST['type'];
    $userid= $_POST['userid'];
    $password= $_POST['password'];
    $result="";
    if($type=="0")
    {
    	$result = mysqli_query($con,'select * from admin where admin_id="'.$userid.'" and password="'.$password.'"');
    }
    elseif($type=="1")
    {
    	$result = mysqli_query($con,'select * from faculty where faculty_id="'.$userid.'" and password="'.$password.'"');
    }
    elseif($type=="2")
    {
    	$result = mysqli_query($con,'select * from student where student_id="'.$userid.'" and password="'.$password.'"');
    }
    if (mysqli_num_rows($result) == 1)
    {
        $_SESSION['userid']= $userid;
        if ($type=="0") {
        	header('Location: admin.php');
        }
        elseif ($type=="1") {
        	header('Location: faculty.php');
        }
        elseif ($type=="2") {
        	header('Location: student.php');
        }
        //$error=1;
    }
    else
    {
       	$error=0;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Automated Lab Assessment System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/java.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body>
	<?php
		if ($error==1)
		{?>
			<script type="text/javascript">
        		swal("Congrats!", "You have sucessfully login!", "success");
        	</script>
			<?php
		}
		elseif($error==0)
		{?>
			<script type="text/javascript">
    			swal("Sorry!", "Invalid Username or Password!", "error");
    		</script>
    	<?php
		}
		?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/system.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" method="POST" action="">
					<div class="login100-form-avatar">
						<img src="images/login.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Login
					</span>
					<!-- <p style="color: red;text-align: center;font-size: 20px"><?php  $error; ?> </p> -->
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Type of Account">
						<select name="type" class="input100" required>
                    		<option value="0">ADMIN</option>
                    		<option value="1">FACULTY</option>
                    		<option value="2">STUDENT</option>
                    	</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "User ID is required">
						<input class="input100" type="number" name="userid" placeholder="User ID" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" name="submit">
							Login
						</button>
					</div>
					<!-- <div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							Forgot Username / Password?
						</a>
					</div>

					<div class="text-center w-full">
						<a class="txt1" href="#">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>