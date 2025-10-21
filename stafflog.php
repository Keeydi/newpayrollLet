<?php
include('admin/connection.php');
include('sanitise.php');

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = sanitise($_POST['staff_id']);
    $username = sanitise($_POST['username']);
    $password = sanitise($_POST['password']);
    
    if (empty($staff_id) || empty($username) || empty($password)) {
        $error_message = "Please fill in all fields.";
    } else {
        $qry = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id' AND username = '$username' AND password = '$password'");
        $count = mysqli_num_rows($qry);
        
        if ($count == 1) {
            session_start();
            $_SESSION['staff_id'] = $staff_id;
            header('Location: employee/index.php');
            exit();
        } else {
            $error_message = "Invalid login credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Login Error - Payroll System</title>
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

.error-container {
	background: #ffffff;
	border-radius: 15px;
	box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
	padding: 30px;
	width: 400px;
	max-width: 90%;
	border: 1px solid #e0e0e0;
	text-align: center;
	position: relative;
}

.error-container::after {
	content: '';
	position: fixed;
	top: -20px;
	right: calc(50% - 200px - 8px - 96px - 250px);
	width: 250px;
	height: calc(100vh + 40px);
	background: linear-gradient(to top, #8B0000, #FF6B6B);
}

.error-message {
	background: #f8d7da;
	color: #721c24;
	padding: 15px;
	border-radius: 8px;
	margin-bottom: 20px;
	border: 1px solid #f5c6cb;
}

.back-btn {
	display: inline-block;
	padding: 12px 30px;
	background: #007bff;
	color: white;
	text-decoration: none;
	border-radius: 8px;
	font-weight: 600;
	transition: background-color 0.3s ease;
}

.back-btn:hover {
	background: #0056b3;
	text-decoration: none;
	color: white;
}
</style>
</head>
<body>
<div class="error-container">
	<h2>Staff Login Error</h2>
	<?php if ($error_message): ?>
		<div class="error-message"><?php echo $error_message; ?></div>
	<?php endif; ?>
	<a href="index.php" class="back-btn">Back to Login</a>
</div>
</body>
</html>