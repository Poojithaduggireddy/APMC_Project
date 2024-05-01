<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container">
	<div class="screen">
		<div class="screen__content">	
		    
			<form class="login" method="POST" action="login.php">
			<p style="text-align: center;font-size:30px;color:#58332b ;"><b>LOGIN PAGE</b></p>
			<?php
			session_start();
			if(isset($_SESSION['error_message'])) {
				echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
				unset($_SESSION['error_message']); // Clear the error message
			}
			?>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="User name" name="username">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password" id="password">
					<button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
						<i class="fas fa-eye"></i>
					</button>
				</div>
								
                <div class="login__field">
					<i class="login__icon fas fa-user"></i>
                    <select class="login__input" name="role">
						<option value="agent">Agent</option>
						<option value="manager">Manager</option>
						<option value="admin">Admin</option>
					</select>
				</div>
				<button class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>
								
			</form>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<script>
	
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var icon = document.querySelector('.password-toggle i');
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
    // Prevent button click from submitting form
    return false;
}
</script>
</html>

