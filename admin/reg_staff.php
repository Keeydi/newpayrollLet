<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Staff</title>
<link rel="stylesheet" href="../css/style.css?v=20250107" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/tcal.css" type="text/css" />
<script type="text/javascript" src="../css/tcal.js"></script>
<script type="text/javascript">
	function proceed() 
	{
	  return confirm('Click to confirm registration');
	}
</script>
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
			<div class="brand">Payroll Management System</div>
		</div>
		
		<div class="user-profile">
			<div class="avatar" onclick="toggleProfile()">
				<?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
			</div>
			<div class="profile-dropdown" id="profileDropdown">
				<ul>
					<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="layout" id="layout">
		<div class="sidebar">
			<ul class="nav-list">
				<li class="nav-item">
					<a href="index.php" class="nav-link">
						<i class="fas fa-home nav-icon"></i>
						<span class="nav-text">Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="reg_staff.php" class="nav-link active">
						<i class="fas fa-user-plus nav-icon"></i>
						<span class="nav-text">Register Staff</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="view_staff.php" class="nav-link">
						<i class="fas fa-users nav-icon"></i>
						<span class="nav-text">View Staff</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="payroll.php" class="nav-link">
						<i class="fas fa-money-bill-wave nav-icon"></i>
						<span class="nav-text">Payroll</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="sentmessages.php" class="nav-link">
						<i class="fas fa-paper-plane nav-icon"></i>
						<span class="nav-text">Messages</span>
					</a>
				</li>
			</ul>
		</div>

		<main class="main">
			<div class="card">
				<h3>
					<i class="fas fa-user-plus card-icon"></i>
					Register New Staff Member
				</h3>
				
				<form name="register" action="reg.php" method="post" class="staff-form">
					<div class="form-grid">
						<div class="form-group">
							<label for="fname">
								<i class="fas fa-user"></i>
								Full Name
							</label>
							<input type="text" name="fname" id="fname" required />
						</div>

						<div class="form-group">
							<label for="sex">
								<i class="fas fa-venus-mars"></i>
								Sex
							</label>
							<select name="sex" id="sex" required>
								<option value="" selected>Select sex</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>

						<div class="form-group">
							<label for="birthday">
								<i class="fas fa-calendar"></i>
								Birthday
							</label>
							<input type="text" name="birthday" id="birthday" class="tcal" required />
						</div>

						<div class="form-group">
							<label for="department">
								<i class="fas fa-building"></i>
								Department
							</label>
							<select name="department" id="department" required>
								<option value="" selected>Select Department</option>
								<option value="Human Resources">Human Resources</option>
								<option value="I.T.">I.T.</option>
								<option value="Accounting">Accounting</option>
								<option value="Research">Research & Development</option>
								<option value="Administration">Administration</option>
								<option value="Marketing">Marketing</option>
								<option value="Production">Production</option>
							</select>
						</div>

						<div class="form-group">
							<label for="position">
								<i class="fas fa-briefcase"></i>
								Position
							</label>
							<select name="position" id="position" required>
								<option value="" selected>Select Position</option>
								<option value="Director">Director</option>
								<option value="As. Director">As. Director</option>
								<option value="Manager">Manager</option>
								<option value="As.Manager">As. Manager</option>
								<option value="Supervisor">Supervisor</option>
								<option value="Head">Head</option>
								<option value="Ass. Head">Ass. Head</option>
								<option value="Clerk">Clerk</option>
							</select>
						</div>

						<div class="form-group">
							<label for="grade">
								<i class="fas fa-star"></i>
								Grade Level
							</label>
							<input type="text" name="grade" id="grade" required />
						</div>

						<div class="form-group">
							<label for="years">
								<i class="fas fa-clock"></i>
								Years Spent
							</label>
							<input type="text" name="years" id="years" required />
						</div>

						<div class="form-group">
							<label for="username">
								<i class="fas fa-user-circle"></i>
								Username
							</label>
							<input type="text" name="username" id="username" required />
						</div>

						<div class="form-group">
							<label for="password">
								<i class="fas fa-lock"></i>
								Password
							</label>
							<input type="password" name="password" id="password" required minlength="7" />
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" name="submit" id="submit" class="btn" onclick="return proceed()">
							<i class="fas fa-user-plus"></i>
							Register Staff
						</button>
					</div>
				</form>
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