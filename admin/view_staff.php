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
<title>View Staff</title>
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
					<a href="reg_staff.php" class="nav-link">
						<i class="fas fa-user-plus nav-icon"></i>
						<span class="nav-text">Register Staff</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="view_staff.php" class="nav-link active">
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
			<div class="data-table">
				<div style="padding: 20px 24px 16px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
					<h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-users" style="width: 20px; height: 20px; color: #667eea;"></i>
						Staff Directory
					</h3>
				</div>
				
				<div style="overflow-x: auto;">
					<table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
						<thead>
							<tr>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-id-card"></i> Staff ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-user"></i> Full Name</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-venus-mars"></i> Sex</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Birthday</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-building"></i> Department</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-briefcase"></i> Position</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-star"></i> Grade</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-clock"></i> Years</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar-check"></i> Date Employed</th>
								<th style="padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-cogs"></i> Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//database connection
							include('connection.php');

							//view record
							$qry = mysqli_query($conn, "SELECT * FROM register_staff");
							
							while ($row = mysqli_fetch_array($qry))
							{
								echo "<tr style='transition: all 0.3s ease;' onmouseover=\"this.style.background='rgba(102, 126, 234, 0.05)'\" onmouseout=\"this.style.background='transparent'\">";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['staff_id'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['fname'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['sex'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['birthday'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['department'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['position'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['grade'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['years'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['date_registered'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>";
								echo "<div style='display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;'>";
								echo "<a href='delete.php?staff_id=" . $row['staff_id'] . "' style='background: #e53e3e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#c53030'\" onmouseout=\"this.style.background='#e53e3e'\"><i class='fas fa-trash'></i> Delete</a>";
								echo "<a href='up_staff.php?staff_id=" . $row['staff_id'] . "' style='background: #3182ce; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#2c5282'\" onmouseout=\"this.style.background='#3182ce'\"><i class='fas fa-edit'></i> Update</a>";
								echo "<a href='im.php?staff_id=" . $row['staff_id'] . "' style='background: #38a169; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#2f855a'\" onmouseout=\"this.style.background='#38a169'\"><i class='fas fa-envelope'></i> Message</a>";
								echo "</div>";
								echo "</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card" style="margin-top: 24px;">
				<h3>
					<i class="fas fa-link card-icon"></i>
					Quick Actions
				</h3>
				<div style="display: flex; gap: 16px; flex-wrap: wrap;">
					<a href="index.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-home"></i>
						Go Home
					</a>
					<a href="payroll.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-calculator"></i>
						Calculate Payroll
					</a>
					<a href="reg_staff.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-user-plus"></i>
						Add New Staff
					</a>
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