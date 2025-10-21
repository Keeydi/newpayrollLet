<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password - Payroll System</title>

<style>
body {
	background-color: #ebe8e1;
	margin: 0;
	padding: 0;
	font-family: Arial, sans-serif;
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
}

.reset-container {
	background: #ffffff;
	padding: 30px;
	width: 400px;
	max-width: 90%;
	border: 1px solid #ccc;
}

.reset-header {
	text-align: center;
	margin-bottom: 30px;
}

.reset-header h1 {
	color: #333;
	margin: 0;
	font-size: 24px;
}

.reset-header p {
	color: #666;
	margin: 10px 0 0 0;
	font-size: 14px;
}

.form-group {
	margin-bottom: 20px;
}

.form-group label {
	display: block;
	margin-bottom: 5px;
	color: #333;
	font-weight: bold;
}

.form-group input {
	width: 100%;
	padding: 10px;
	border: 1px solid #ccc;
	font-size: 16px;
	box-sizing: border-box;
}

.reset-btn {
	width: 100%;
	padding: 12px;
	background: #dc3545;
	color: white;
	border: none;
	font-size: 16px;
	font-weight: bold;
	cursor: pointer;
	margin-bottom: 15px;
}

.reset-btn:hover {
	background: #c82333;
}

.back-to-login {
	text-align: center;
	padding-top: 20px;
	border-top: 1px solid #ccc;
}

.back-to-login a {
	color: #dc3545;
	text-decoration: none;
	font-weight: bold;
}

.back-to-login a:hover {
	text-decoration: underline;
}
</style>
</head>

<body>
<div class="reset-container">
	<div class="reset-header">
		<h1>Reset Password</h1>
		<p>Enter your staff ID and new password</p>
	</div>

	<form method="post" action="reset.php">
		<div class="form-group">
			<label for="staff_id">Staff ID</label>
			<input type="text" name="staff_id" id="staff_id" required>
		</div>
		
		<div class="form-group">
			<label for="password">New Password</label>
			<input type="password" name="password" id="password" required minlength="6">
		</div>
		
		<div class="form-group">
			<label for="newpassword">Confirm New Password</label>
			<input type="password" name="newpassword" id="newpassword" required minlength="6">
		</div>
		
		<button type="submit" class="reset-btn">Reset Password</button>
	</form>

	<div class="back-to-login">
		<a href="index.php">Back to Login</a>
	</div>
</div>

<script>
// Password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
	const password = document.getElementById('password');
	const confirmPassword = document.getElementById('newpassword');
	
	function validatePassword() {
		if (password.value !== confirmPassword.value) {
			confirmPassword.setCustomValidity("Passwords don't match");
		} else {
			confirmPassword.setCustomValidity('');
		}
	}
	
	password.addEventListener('change', validatePassword);
	confirmPassword.addEventListener('keyup', validatePassword);
});
</script>
</body>
</html>