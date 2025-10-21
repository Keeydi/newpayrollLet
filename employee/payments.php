<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}

$staff_id = $_SESSION['staff_id'];
$qry = mysqli_query($conn, "SELECT * FROM salary WHERE staff_id = '$staff_id'");

// Get staff name for avatar
$staff_qry = mysqli_query($conn, "SELECT fname FROM register_staff WHERE staff_id = '$staff_id'");
$staff_data = mysqli_fetch_array($staff_qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Payments</title>
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
					<a href="index.php" class="nav-link">
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
					<a href="payments.php" class="nav-link active">
						<i class="fas fa-money-bill-wave nav-icon"></i>
						<span class="nav-text">Payments</span>
					</a>
				</li>
			</ul>
		</div>

		<main class="main">
			<div class="data-table">
				<div style="padding: 20px 24px 16px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
					<h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-money-bill-wave" style="width: 20px; height: 20px; color: #667eea;"></i>
						Payment History
					</h3>
					<p style="margin: 8px 0 0 0; color: #718096; font-size: 14px;">View your salary payments and breakdown</p>
				</div>
				
				<div style="overflow-x: auto;">
					<table style="width: 100%; border-collapse: collapse; min-width: 1200px;">
						<thead>
							<tr>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Month</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-money-bill-wave"></i> Basic</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-utensils"></i> Meal</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-home"></i> Housing</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-car"></i> Transport</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-glass-cheers"></i> Entertainment</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-medal"></i> Long Service</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-receipt"></i> Tax</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calculator"></i> Net Pay</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($tbl = mysqli_fetch_array($qry)) { ?>
							<tr style="transition: all 0.3s ease;" onmouseover="this.style.background='rgba(102, 126, 234, 0.05)'" onmouseout="this.style.background='transparent'">
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;"><?php echo $tbl['date_s']; ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['basic'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['meal'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['housing'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['transport'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['entertainment'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['long_service'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">₦<?php echo number_format(round($tbl['tax'])); ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 700; color: #2d3748;">₦<?php echo number_format(round($tbl['totall'])); ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card" style="margin-top: 24px;">
				<h3>
					<i class="fas fa-chart-bar card-icon"></i>
					Payment Summary
				</h3>
				<div class="payment-summary">
					<?php
					// Calculate totals
					$total_qry = mysqli_query($conn, "SELECT SUM(basic) as total_basic, SUM(meal) as total_meal, SUM(housing) as total_housing, SUM(transport) as total_transport, SUM(entertainment) as total_entertainment, SUM(long_service) as total_long_service, SUM(tax) as total_tax, SUM(totall) as total_net FROM salary WHERE staff_id = '$staff_id'");
					$totals = mysqli_fetch_array($total_qry);
					?>
					<div class="summary-grid">
						<div class="summary-item">
							<label><i class="fas fa-money-bill-wave"></i> Total Basic Salary</label>
							<div class="summary-value">₦<?php echo number_format(round($totals['total_basic'])); ?></div>
						</div>
						<div class="summary-item">
							<label><i class="fas fa-plus"></i> Total Allowances</label>
							<div class="summary-value">₦<?php echo number_format(round($totals['total_meal'] + $totals['total_housing'] + $totals['total_transport'] + $totals['total_entertainment'] + $totals['total_long_service'])); ?></div>
						</div>
						<div class="summary-item">
							<label><i class="fas fa-minus"></i> Total Tax Deducted</label>
							<div class="summary-value">₦<?php echo number_format(round($totals['total_tax'])); ?></div>
						</div>
						<div class="summary-item highlight">
							<label><i class="fas fa-calculator"></i> Total Net Pay</label>
							<div class="summary-value">₦<?php echo number_format(round($totals['total_net'])); ?></div>
						</div>
					</div>
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
						Dashboard
					</a>
					<a href="inbox.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-inbox"></i>
						Messages
					</a>
					<a href="compose2.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-edit"></i>
						Compose Message
					</a>
					<a href="profile.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-user-circle"></i>
						View Profile
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