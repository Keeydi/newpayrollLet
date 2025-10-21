<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}

$staff_id = $_SESSION['staff_id'];
$qry = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id'");
$staff_data = mysqli_fetch_array($qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Dashboard</title>
<link rel="stylesheet" href="../css/style.css?v=20250107" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

<div class="app-shell">

	<div class="headerbar">
		<div class="brand-wrap">
			<button class="hamburger" id="sidebarToggle">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<div class="brand">Staff Portal</div>
		</div>
		
		<div class="user-profile">
			<div class="avatar" onclick="toggleProfile()">
				<?php echo strtoupper(substr($staff_data['fname'], 0, 1)); ?>
			</div>
			<div class="profile-dropdown" id="profileDropdown">
				<ul>
					<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
					<li><a href="resetpassword.php"><i class="fas fa-key"></i> Change Password</a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="layout" id="layout">
		<div class="sidebar">
			<ul class="nav-list">
				<li class="nav-item">
					<a href="index.php" class="nav-link active">
						<i class="fas fa-home nav-icon"></i>
						<span class="nav-text">Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="inbox.php" class="nav-link">
						<i class="fas fa-inbox nav-icon"></i>
						<span class="nav-text">Messages</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="compose2.php" class="nav-link">
						<i class="fas fa-edit nav-icon"></i>
						<span class="nav-text">Compose</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="outbox.php" class="nav-link">
						<i class="fas fa-paper-plane nav-icon"></i>
						<span class="nav-text">Sent Messages</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="payments.php" class="nav-link">
						<i class="fas fa-money-bill-wave nav-icon"></i>
						<span class="nav-text">Payments</span>
					</a>
				</li>
			</ul>
		</div>

		<main class="main">
			<div class="cards">
				<div class="card">
					<h3>
						<i class="fas fa-user card-icon"></i>
						Personal Information
					</h3>
					<div class="profile-info">
						<div class="profile-field">
							<label><i class="fas fa-id-card"></i> Staff ID</label>
							<div class="field-value"><?php echo $staff_data['staff_id']; ?></div>
						</div>
						<div class="profile-field">
							<label><i class="fas fa-user"></i> Full Name</label>
							<div class="field-value"><?php echo $staff_data['fname']; ?></div>
						</div>
						<div class="profile-field">
							<label><i class="fas fa-building"></i> Department</label>
							<div class="field-value"><?php echo $staff_data['department']; ?></div>
						</div>
						<div class="profile-field">
							<label><i class="fas fa-briefcase"></i> Position</label>
							<div class="field-value"><?php echo $staff_data['position']; ?></div>
						</div>
						<div class="profile-field">
							<label><i class="fas fa-calendar-check"></i> Date Joined</label>
							<div class="field-value"><?php echo $staff_data['date_registered']; ?></div>
						</div>
					</div>
				</div>

				<div class="card">
					<h3>
						<i class="fas fa-chart-line card-icon"></i>
						Quick Actions
					</h3>
					<div class="quick-actions">
						<a href="profile.php" class="action-btn">
							<i class="fas fa-user-circle"></i>
							<span>View Complete Profile</span>
						</a>
						<a href="resetpassword.php" class="action-btn">
							<i class="fas fa-key"></i>
							<span>Change Password</span>
						</a>
						<a href="payments.php" class="action-btn">
							<i class="fas fa-money-bill-wave"></i>
							<span>View Payments</span>
						</a>
						<a href="inbox.php" class="action-btn">
							<i class="fas fa-inbox"></i>
							<span>Check Messages</span>
						</a>
					</div>
				</div>
			</div>

			<div class="card" style="margin-top: 24px;">
				<h3>
					<i class="fas fa-info-circle card-icon"></i>
					Welcome Message
				</h3>
				<div class="welcome-message">
					<p>Welcome to your staff portal, <strong><?php echo $staff_data['fname']; ?></strong>!</p>
					<p>From here you can manage your profile, view your payment history, and communicate with the administration team.</p>
					<div class="welcome-actions">
						<a href="profile.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
							<i class="fas fa-user-circle"></i>
							Update Profile
						</a>
						<a href="payments.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
							<i class="fas fa-chart-bar"></i>
							View Payments
						</a>
					</div>
				</div>
			</div>
		</main>
	</div>
</div>

<script type="text/javascript">
// Modern sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
	const toggleBtn = document.getElementById('sidebarToggle');
	const layoutEl = document.getElementById('layout');
	
	toggleBtn.addEventListener('click', function() {
		layoutEl.classList.toggle('sidebar-collapsed');
	});
});

// Profile dropdown functionality
function toggleProfile() {
	const dropdown = document.getElementById('profileDropdown');
	dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
	const dropdown = document.getElementById('profileDropdown');
	const avatar = document.querySelector('.avatar');
	
	if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
		dropdown.classList.remove('show');
	}
});
</script>

</body>
</html>