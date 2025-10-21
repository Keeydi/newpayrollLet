<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}

//database connection
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Print PaySlip</title>
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
					<a href="print.php" class="nav-link active">
						<i class="fas fa-print nav-icon"></i>
						<span class="nav-text">Print Slip</span>
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
						<i class="fas fa-print" style="width: 20px; height: 20px; color: #667eea;"></i>
						Print PaySlip
					</h3>
					<p style="margin: 8px 0 0 0; color: #718096; font-size: 14px;">Select a salary record to print the payslip</p>
				</div>
				
				<div style="overflow-x: auto;">
					<table style="width: 100%; border-collapse: collapse; min-width: 1400px;">
						<thead>
							<tr>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-hashtag"></i> Salary ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-id-card"></i> Staff ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-user"></i> Full Name</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-building"></i> Department</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-briefcase"></i> Position</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-star"></i> Grade</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-clock"></i> Years</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-money-bill-wave"></i> Basic</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-utensils"></i> Meal</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-home"></i> Housing</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-car"></i> Transport</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-glass-cheers"></i> Entertainment</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-medal"></i> Long Service</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-receipt"></i> Tax</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calculator"></i> Total</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Date</th>
								<th style="padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-cogs"></i> Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//view record
							$qry = mysqli_query($conn, "SELECT * FROM salary");
							
							while ($row = mysqli_fetch_array($qry))
							{
								echo "<tr style='transition: all 0.3s ease;' onmouseover=\"this.style.background='rgba(102, 126, 234, 0.05)'\" onmouseout=\"this.style.background='transparent'\">";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['salary_id'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['staff_id'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['fname'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['department'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['position'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['grade'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['years'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['basic'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['meal'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['housing'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['transport'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['entertainment'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['long_service'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>₦" . number_format(round($row['tax'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500; font-weight: 700; color: #2d3748;'>₦" . number_format(round($row['totall'])) . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['date_s'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>";
								echo "<div style='display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;'>";
								echo "<a href='payslip.php?staff_id=" . $row['staff_id'] . "&salary_id=" . $row['salary_id'] . "' style='background: #38a169; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#2f855a'\" onmouseout=\"this.style.background='#38a169'\"><i class='fas fa-print'></i> Print</a>";
								echo "<a href='salary_delete.php?salary_id=" . $row['salary_id'] . "&staff_id=" . $row['staff_id'] . "&salary_id=" . $row['salary_id'] . "' style='background: #e53e3e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#c53030'\" onmouseout=\"this.style.background='#e53e3e'\" onclick=\"return confirm('Are you sure you want to delete this salary record?')\"><i class='fas fa-trash'></i> Delete</a>";
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
					<a href="view_staff.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-users"></i>
						View Staff
					</a>
					<a href="sentmessages.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-paper-plane"></i>
						Messages
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