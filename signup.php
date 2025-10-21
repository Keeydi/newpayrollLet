<?php
include('admin/connection.php');
include('sanitise.php');

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = sanitise($_POST['fname']);
    $sex = sanitise($_POST['sex']);
    $birthday = sanitise($_POST['birthday']);
    $department = sanitise($_POST['department']);
    $position = sanitise($_POST['position']);
    $grade = sanitise($_POST['grade']);
    $years = sanitise($_POST['years']);
    $username = sanitise($_POST['username']);
    $password = sanitise($_POST['password']);
    $confirm_password = sanitise($_POST['confirm_password']);
    
    // Validation
    if (empty($fname) || empty($sex) || empty($birthday) || empty($department) || 
        empty($position) || empty($grade) || empty($years) || empty($username) || 
        empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Check if username already exists
        $check_query = mysqli_query($conn, "SELECT * FROM register_staff WHERE username = '$username'");
        if (mysqli_num_rows($check_query) > 0) {
            $error_message = "Username already exists. Please choose a different username.";
        } else {
            // Insert new staff member
            $insert_query = "INSERT INTO register_staff (fname, sex, birthday, department, position, grade, years, username, password, date_registered) 
                            VALUES ('$fname', '$sex', '$birthday', '$department', '$position', '$grade', '$years', '$username', '$password', NOW())";
            
            if (mysqli_query($conn, $insert_query)) {
                $success_message = "Account created successfully! You can now login.";
            } else {
                $error_message = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account - Payroll System</title>
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

.signup-container {
	background: #ffffff;
	border-radius: 15px;
	box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
	padding: 15px;
	width: 420px;
	max-width: 90%;
	border: 1px solid #e0e0e0;
	max-height: 98vh;
	overflow: hidden;
	position: relative;
}

.signup-container::after {
    content: none; /* removed decorative vertical panel */
}

.signup-header {
	text-align: center;
	margin-bottom: 15px;
}

.signup-header h1 {
	color: #333;
	margin: 0;
	font-size: 22px;
	font-weight: 300;
}

.signup-header p {
	color: #666;
	margin: 5px 0 0 0;
	font-size: 12px;
}

.form-row {
	display: flex;
	gap: 10px;
	margin-bottom: 12px;
}

.form-group {
	flex: 1;
	margin-bottom: 12px;
}

.form-group.full-width {
	flex: 100%;
}

.form-group label {
	display: block;
	margin-bottom: 4px;
	color: #333;
	font-weight: 500;
	font-size: 12px;
}

.form-group input,
.form-group select {
	width: 100%;
	padding: 8px 10px;
	border: 2px solid #e0e0e0;
	border-radius: 5px;
	font-size: 13px;
	transition: border-color 0.3s ease;
	box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #dc3545;
}

.signup-btn {
    width: 100%;
    padding: 8px;
    background: #dc3545; /* unified red buttons */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 10px;
}

.signup-btn:hover {
    background: #c82333;
}

.signup-btn:active {
	transform: translateY(1px);
}

.back-to-login {
	text-align: center;
	padding-top: 10px;
	border-top: 1px solid #e0e0e0;
}

.back-to-login a {
    color: #dc3545;
    text-decoration: none;
    font-size: 12px;
}

.back-to-login a:hover {
	text-decoration: underline;
}

.error-message {
	background: #f8d7da;
	color: #721c24;
	padding: 6px;
	border-radius: 4px;
	margin-bottom: 10px;
	border: 1px solid #f5c6cb;
	text-align: center;
	font-size: 12px;
}

.success-message {
	background: #d4edda;
	color: #155724;
	padding: 6px;
	border-radius: 4px;
	margin-bottom: 10px;
	border: 1px solid #c3e6cb;
	text-align: center;
	font-size: 12px;
}

@media (max-width: 600px) {
	.signup-container {
		margin: 20px;
		padding: 20px;
	}
	
	.form-row {
		flex-direction: column;
		gap: 0;
	}
	
	.signup-header h1 {
		font-size: 24px;
	}
}
</style>
</head>

<body>
<div class="signup-container">
	<div class="signup-header">
		<h1>Create Account</h1>
		<p>Join our payroll system</p>
	</div>

	<?php if ($error_message): ?>
		<div class="error-message"><?php echo $error_message; ?></div>
	<?php endif; ?>

	<?php if ($success_message): ?>
		<div class="success-message"><?php echo $success_message; ?></div>
	<?php endif; ?>

	<form method="post" action="signup.php">
		<div class="form-group full-width">
			<label for="fname">Full Name</label>
			<input type="text" name="fname" id="fname" required value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>">
		</div>

		<div class="form-row">
			<div class="form-group">
				<label for="sex">Gender</label>
				<select name="sex" id="sex" required>
					<option value="">Select Gender</option>
					<option value="Male" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
					<option value="Female" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
				</select>
			</div>
			<div class="form-group">
				<label for="birthday">Birthday</label>
				<input type="date" name="birthday" id="birthday" required value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : ''; ?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group">
				<label for="department">Department</label>
				<select name="department" id="department" required>
					<option value="">Select Department</option>
					<option value="I.T." <?php echo (isset($_POST['department']) && $_POST['department'] == 'I.T.') ? 'selected' : ''; ?>>I.T.</option>
					<option value="Human Resources" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Human Resources') ? 'selected' : ''; ?>>Human Resources</option>
					<option value="Accounting" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Accounting') ? 'selected' : ''; ?>>Accounting</option>
					<option value="Administration" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Administration') ? 'selected' : ''; ?>>Administration</option>
					<option value="Marketing" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
					<option value="Production" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Production') ? 'selected' : ''; ?>>Production</option>
				</select>
			</div>
			<div class="form-group">
				<label for="position">Position</label>
				<input type="text" name="position" id="position" required value="<?php echo isset($_POST['position']) ? htmlspecialchars($_POST['position']) : ''; ?>" placeholder="e.g., Manager, Director">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group">
				<label for="grade">Grade</label>
				<input type="number" name="grade" id="grade" required min="1" max="20" value="<?php echo isset($_POST['grade']) ? htmlspecialchars($_POST['grade']) : ''; ?>">
			</div>
			<div class="form-group">
				<label for="years">Years of Experience</label>
				<input type="number" name="years" id="years" required min="0" max="50" value="<?php echo isset($_POST['years']) ? htmlspecialchars($_POST['years']) : ''; ?>">
			</div>
		</div>

		<div class="form-group full-width">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
		</div>

		<div class="form-row">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required minlength="6">
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password" id="confirm_password" required minlength="6">
			</div>
		</div>

		<button type="submit" class="signup-btn">Create Account</button>
	</form>

	<div class="back-to-login">
		<a href="index.php">Already have an account? Sign in</a>
	</div>
</div>

<script>
// Password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
	const password = document.getElementById('password');
	const confirmPassword = document.getElementById('confirm_password');
	
	function validatePassword() {
		if (password.value !== confirmPassword.value) {
			confirmPassword.setCustomValidity("Passwords don't match");
		} else {
			confirmPassword.setCustomValidity('');
		}
	}
	
	password.addEventListener('change', validatePassword);
	confirmPassword.addEventListener('keyup', validatePassword);
	
	// Form validation
	const form = document.querySelector('form');
	form.addEventListener('submit', function(e) {
		const inputs = form.querySelectorAll('input[required], select[required]');
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
</script>
</body>
</html>
