<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payroll System - Login</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<style>
body {
	background-color: #ebe8e1;
	margin: 0;
	padding: 0;
	font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
}

.login-container {
	background: #ffffff;
	border-radius: 15px;
	box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
	padding: 30px;
	width: 400px;
	max-width: 90%;
	border: 1px solid #e0e0e0;
	position: relative;
}

.login-container::after {
    content: none; /* removed decorative vertical panel */
}

.login-header {
	text-align: center;
	margin-bottom: 30px;
}

.login-header h1 {
	color: #333;
	margin: 0;
	font-size: 28px;
	font-weight: 300;
}

.login-header p {
	color: #666;
	margin: 10px 0 0 0;
	font-size: 14px;
}

.tab-container {
	margin-bottom: 20px;
}

.tab-buttons {
	display: flex;
	border-bottom: 2px solid #e0e0e0;
	margin-bottom: 20px;
}

.tab-button {
	flex: 1;
	padding: 12px 20px;
	background: none;
	border: none;
	cursor: pointer;
	font-size: 16px;
	color: #666;
	transition: all 0.3s ease;
	border-bottom: 3px solid transparent;
}

.tab-button.active {
    color: #dc3545; /* red active tab */
    border-bottom-color: #dc3545;
    font-weight: 600;
}

.tab-button:hover {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.1);
}

.tab-content {
	display: none;
}

.tab-content.active {
	display: block;
}

.form-group {
	margin-bottom: 20px;
}

.form-group label {
	display: block;
	margin-bottom: 8px;
	color: #333;
	font-weight: 500;
	font-size: 14px;
}

.form-group input {
	width: 100%;
	padding: 12px 15px;
	border: 2px solid #e0e0e0;
	border-radius: 8px;
	font-size: 16px;
	transition: border-color 0.3s ease;
	box-sizing: border-box;
}

.form-group input:focus {
	outline: none;
	border-color: #007bff;
	box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.login-btn {
    width: 100%;
    padding: 12px;
    background: #dc3545; /* unified red buttons */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 15px;
}

.login-btn:hover {
    background: #c82333;
}

.login-btn:active {
	transform: translateY(1px);
}

.forgot-password {
	text-align: center;
	margin-bottom: 20px;
}

.forgot-password a {
    color: #dc3545;
    text-decoration: none;
    font-size: 14px;
}

.forgot-password a:hover {
	text-decoration: underline;
}

.create-account {
	text-align: center;
	padding-top: 20px;
	border-top: 1px solid #e0e0e0;
}

.create-account p {
	color: #666;
	margin: 0 0 15px 0;
	font-size: 14px;
}

.create-account-btn {
    display: inline-block;
    padding: 12px 30px;
    background: #dc3545; /* red to match buttons */
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.create-account-btn:hover {
    background: #c82333;
    text-decoration: none;
    color: white;
}

.error-message {
	background: #f8d7da;
	color: #721c24;
	padding: 10px;
	border-radius: 5px;
	margin-bottom: 20px;
	border: 1px solid #f5c6cb;
	text-align: center;
}

@media (max-width: 480px) {
	.login-container {
		margin: 20px;
		padding: 20px;
	}
	
	.login-header h1 {
		font-size: 24px;
	}
}
</style>
</head>

<body>
<div class="login-container">
	<div class="login-header">
		<h1>Payroll System</h1>
		<p>Sign in to your account</p>
	</div>

	<div class="tab-container">
		<div class="tab-buttons">
			<button class="tab-button active" onclick="switchTab('admin')">Administrator</button>
			<button class="tab-button" onclick="switchTab('staff')">Staff</button>
		</div>

		<!-- Administrator Login Tab -->
		<div id="admin-tab" class="tab-content active">
			<form method="post" action="login.php">
				<div class="form-group">
					<label for="admin-username">Username</label>
					<input type="text" name="username" id="admin-username" required>
				</div>
				<div class="form-group">
					<label for="admin-password">Password</label>
					<input type="password" name="password" id="admin-password" required>
				</div>
				<button type="submit" class="login-btn">Login as Administrator</button>
			</form>
		</div>

		<!-- Staff Login Tab -->
		<div id="staff-tab" class="tab-content">
			<form method="post" action="stafflog.php">
				<div class="form-group">
					<label for="staff-id">Staff ID</label>
					<input type="text" name="staff_id" id="staff-id" required>
				</div>
				<div class="form-group">
					<label for="staff-username">Username</label>
					<input type="text" name="username" id="staff-username" required>
				</div>
				<div class="form-group">
					<label for="staff-password">Password</label>
					<input type="password" name="password" id="staff-password" required>
				</div>
				<button type="submit" class="login-btn">Login as Staff</button>
			</form>
			<div class="forgot-password">
				<a href="resetpassword.php">Forgot Password?</a>
			</div>
    </div>
  </div>
 
	<!-- Create Account Section -->
	<div class="create-account">
		<p>Don't have an account?</p>
		<a href="signup.php" class="create-account-btn">Create Account</a>
	</div>
</div>

<script>
function switchTab(tabName) {
	// Remove active class from all tabs and buttons
	document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
	document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
	
	// Add active class to selected tab and button
	document.querySelector(`[onclick="switchTab('${tabName}')"]`).classList.add('active');
	document.getElementById(`${tabName}-tab`).classList.add('active');
}

// Add some basic form validation
document.addEventListener('DOMContentLoaded', function() {
	const forms = document.querySelectorAll('form');
	forms.forEach(form => {
		form.addEventListener('submit', function(e) {
			const inputs = form.querySelectorAll('input[required]');
			let isValid = true;
			
			inputs.forEach(input => {
				if (!input.value.trim()) {
					isValid = false;
					input.style.borderColor = '#dc3545';
				} else {
					input.style.borderColor = '#e0e0e0';
				}
			});
			
			if (!isValid) {
				e.preventDefault();
				alert('Please fill in all required fields.');
			}
		});
	});
});
</script>
</body>
</html>